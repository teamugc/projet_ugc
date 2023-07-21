<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


#[MongoDB\Document]
class Movie {
    
    #[MongoDB\Id]
    protected string $id;

    #[MongoDB\Field(type: 'string')]
    protected string $name;

    #[MongoDB\Field(type: 'string')]
    protected string $url;

    #[MongoDB\Field(type: 'string')]
    protected string $date;
    
    #[MongoDB\Field(type: 'string')]
    protected string $date_fr;

    #[MongoDB\Field(type: 'float')]
    protected float $tmdbVoteAvg;

    #[MongoDB\Field(type: 'string')]
    protected string $tmdbOverview;

    #[MongoDB\Field(type: 'string')]
    protected string $tmdbPoster;

    #[MongoDB\Field(type: 'string')]
    protected string $tmdbGenre;

    public function __construct(array $datas)
    {
        $this->name     = isset($datas['name'])     ? $datas['name'] : '' ;
        $this->url      = isset($datas['url'])      ? $datas['url'] : '' ;
        $this->date     = isset($datas['date'])     ? $datas['date'] : '' ;
        $this->date_fr  = isset($datas['date_fr'])  ? $datas['date_fr'] : '' ;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Movie
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Movie
    {
        $this->url = $url;

        return $this;
    }

    public function setDate(string $date): Movie
    {
        $this->date = $date;

        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }   

    public function setDateFr(string $date_fr): Movie
    {
        $this->date_fr = $date_fr;

        return $this;
    }

    public function getDateFr(): string
    {
        return $this->date_fr;
    }

    public function setTmdbVoteAvg($tmdbVoteAvg)
    {
        $this->tmdbVoteAvg = $tmdbVoteAvg;
    }

    public function setTmdbOverview($tmdbOverview)
    {
        $this->tmdbOverview = $tmdbOverview;
    }

    public function setTmdbPoster($tmdbPoster)
    {
        $this->tmdbPoster = $tmdbPoster;
    }

    public function setTmdbGenre($tmdbGenre)
    {
        $this->tmdbGenre = $tmdbGenre;
    }
}
