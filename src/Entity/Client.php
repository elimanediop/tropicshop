<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


 /**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @UniqueEntity(
 *     fields={ "cli_mail" },
 *     message="Cet email est déjà utilisé !"
 * )
 *
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cli_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cli_prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="L'adresse mail '{{ value }}' n'est pas valide.")
     */
    private $cli_mail;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(pattern="/^([0-9]{13})$/s",
     *     match=true,
     *     message="Votre numéro doit être au format 00336xxx.")
     */
    private $cli_tel;


     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/^(?=.*[A-Za-z])(?=.*\d).{6,}$/s",
     *     match=true,
     *     message="Votre mot de passe doit comporter au moins 8 caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole.")
     */
    private $cli_mdp;

    /**
     * @var
     * @Assert\EqualTo(propertyPath="cli_mdp", message="Votre mot de passe saisi n'est pas identique")
     */
    private $cli_confirm_mdp;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $cli_adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliNom(): ?string
    {
        return $this->cli_nom;
    }

    public function setCliNom(string $cli_nom): self
    {
        $this->cli_nom = $cli_nom;

        return $this;
    }

    public function getCliPrenom(): ?string
    {
        return $this->cli_prenom;
    }

    public function setCliPrenom(string $cli_prenom): self
    {
        $this->cli_prenom = $cli_prenom;

        return $this;
    }

    public function getCliMail(): ?string
    {
        return $this->cli_mail;
    }

    public function setCliMail(string $cli_mail): self
    {
        $this->cli_mail = $cli_mail;

        return $this;
    }

    public function getCliTel(): ?string
    {
        return $this->cli_tel;
    }

    public function setCliTel(?string $cli_tel): self
    {
        $this->cli_tel = $cli_tel;

        return $this;
    }

    public function getCliMdp(): ?string
    {
        return $this->cli_mdp;
    }

    public function setCliMdp(string $cli_mdp): self
    {
        $this->cli_mdp = $cli_mdp;

        return $this;
    }

    public function getCliAdresse(): ?Address
    {
        return $this->cli_adresse;
    }

    public function setCliAdresse(Address $cli_adresse): self
    {
        $this->cli_adresse = $cli_adresse;

        return $this;
    }

    public function getCliConfirmMdp(): ?string{
      return $this->cli_confirm_mdp;
    }

    public function setCliConfirmMdp(string $cli_confirm_mdp): self{
      $this->cli_confirm_mdp = $cli_confirm_mdp;
      return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->getCliMdp();
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
        return $this->getCliMail();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
