<?php

namespace App\Domain\Auth;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Auth\UserRepository")
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private ?string $username;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private ?string $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        return array_unique($roles);
    }

    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        // allows for chaining
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize(): ?string
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @param $serialized
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized): void
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

}
