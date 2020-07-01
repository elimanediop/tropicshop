<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


 /**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *     fields={ "mail" },
 *     message="Cet email est déjà utilisé !"
 * )
 *
 */
class User implements UserInterface
{
    public $USER_CLIENT = "ROLE_USER";
    public $USER_STORE = "ROLE_STORE";
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="L'adresse mail '{{ value }}' n'est pas valide.")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(pattern="/([0-9]{10})/s",
     *     match=true,
     *     message="Votre numéro doit être au format 06xxx.")
     */
    private $tel;


     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/^(?=.*[A-Za-z])(?=.*\d).{6,}$/s",
     *     match=true,
     *     message="Votre mot de passe doit comporter au moins 8 caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole.")
     */
    private $password;

    /**
     * @var string $confirm_password
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe saisi n'est pas identique")
     */
    private $confirm_password;

    /**
     *@ORM\Column(type="string", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role = "ROLE_USER";

    /**
     * @ORM\Column(type="integer")
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nommagasin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $cli_nom): self
    {
        $this->nom = $cli_nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $cli_tel): self
    {
        $this->tel = $cli_tel;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $cli_mdp): self
    {
        $this->password = $cli_mdp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $cli_adresse): self
    {
        $this->adresse = $cli_adresse;

        return $this;
    }

    public function getConfirmPassword(): ?string{
      return $this->confirm_password;
    }

    public function setConfirmPassword(string $cli_confirm_mdp): self{
      $this->confirm_password = $cli_confirm_mdp;
      return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return [$this->role];
    }


    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->getMail();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function isStore(){
        if($this->role === $this->USER_STORE)
            return true;
        else
            return false;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNommagasin(): ?string
    {
        return $this->nommagasin;
    }

    public function setNommagasin(?string $nommagasin): self
    {
        $this->nommagasin = $nommagasin;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

}
