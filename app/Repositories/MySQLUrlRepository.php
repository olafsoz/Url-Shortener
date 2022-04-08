<?php

namespace App\Repositories;

use App\Database;
use App\Models\Url;
use App\Redirect;
use App\Services\UrlServices\Redirect\RedirectRequest;
use App\Services\UrlServices\Shorten\ShortenRequest;
use App\Services\WebServices\MainRequest;
use App\Services\WebServices\MainResponse;
use App\Validation\UrlValidator;
use Doctrine\DBAL\Exception;

class MySQLUrlRepository implements UrlRepository
{
    public function main(MainRequest $request): MainResponse
    {
        try {
            $allFromDatabase = Database::connection()
                ->createQueryBuilder()
                ->select('*')
                ->from('url')
                ->orderBy('id', 'desc')
                ->setFirstResult(0)
                ->setMaxResults(3)
                ->fetchAllAssociative();

            $all = [];

            foreach ($allFromDatabase as $a) {
                $all[] = new Url(
                    $a['longUrl'],
                    $a['shortUrl'],
                    $a['id']
                );
            }
        } catch (Exception $e) {
            echo $e->getMessage();die;
        }
        return new MainResponse(
            $all,
            $request->getPort(),
            $request->getErrors()
        );
    }

    public function shorten(ShortenRequest $request)
    {

        if (UrlValidator::validate($request->getLongUrl()) == false) return;

        $shortUrl = substr(md5(microtime()), rand(0, 26), 11);

        try {
            $exists = Database::connection()
                ->createQueryBuilder()
                ->select('*')
                ->from('url')
                ->where('longUrl = ?')
                ->setParameter(0, $request->getLongUrl())
                ->fetchAssociative();

            if (empty($exists)) {
                Database::connection()
                    ->insert('url', [
                        'longUrl' => $request->getLongUrl(),
                        'shortUrl' => $shortUrl
                    ]);
            } else {
                $alreadyExists = new Url(
                    $exists['longUrl'],
                    $exists['shortUrl'],
                    $exists['id']
                );
                Database::connection()
                    ->update('url', [
                        'longUrl' => $request->getLongUrl(),
                        'shortUrl' => $shortUrl,
                    ], ['id' => $alreadyExists->getId()]
                    );
            }
        } catch (Exception $e) {
            echo $e->getMessage();die;
        }
    }

    public function redirect(RedirectRequest $request): ?string
    {
        try {
            $info = Database::connection()
                ->createQueryBuilder()
                ->select("*")
                ->from('url')
                ->where('shortUrl = ?')
                ->setParameter(0, $request->getHash())
                ->executeQuery()
                ->fetchAssociative();

            if (empty($info)) return null;

            $all = new Url(
                $info['longUrl'],
                $info['shortUrl'],
                $info['id']
            );

            return $all->getLongUrl();

        } catch (Exception $e) {
            echo $e->getMessage();die;
        }
    }
}