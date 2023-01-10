<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $artist = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column]
    private ?array $track_list = [];

    #[ORM\OneToMany(mappedBy: 'album_id', targetEntity: Review::class)]
    private Collection $review_id;

    public function __construct()
    {
        $this->review_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getTrackList(): ?array
    {
        return $this->track_list;
    }

    public function setTrackList(array $track_list): self
    {
        $this->track_list = $track_list;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviewId(): Collection
    {
        return $this->review_id;
    }

    public function addReviewId(Review $reviewId): self
    {
        if (!$this->review_id->contains($reviewId)) {
            $this->review_id->add($reviewId);
            $reviewId->setAlbumId($this);
        }

        return $this;
    }

    public function removeReviewId(Review $reviewId): self
    {
        if ($this->review_id->removeElement($reviewId)) {
            // set the owning side to null (unless already changed)
            if ($reviewId->getAlbumId() === $this) {
                $reviewId->setAlbumId(null);
            }
        }

        return $this;
    }
}
