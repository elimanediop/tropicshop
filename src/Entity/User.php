<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    public $USER_ADMIN = "ROLE_ADMIN";
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
     * @var string $confirm_mail
     * @Assert\EqualTo(propertyPath="mail", message="Votre adresse mail saisie n'est pas identique.")
     */
    private $confirm_mail;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(pattern="/(^[0-9]{10}$)/s",
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
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe saisi n'est pas identique.")
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

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="store")
     */
    private $produits;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotNull (message="Veuillez saisir votre adresse postale et la selectionner dans la liste suggérée sous le champs.")
     * @Assert\Length(min=2, minMessage="Veuillez saisir votre adresse et la selectionner dans la liste suggérée.")
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\Length(min=2, minMessage="Veuillez saisir votre adresse et la selectionner dans la liste suggérée.")
     */
    private $lon;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string $adresse_complete
     */
    private $adresse_complete;


    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }


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

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setStore($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getStore() === $this) {
                $produit->setStore(null);
            }
        }

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(?float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getConfirmMail(): ?string
    {
        return $this->confirm_mail;
    }

    public function setConfirmMail(?string $confirm_mail): self
    {
        $this->confirm_mail = $confirm_mail;

        return $this;
    }

    public function getAdresseComplete(): ?string
    {
        return $this->adresse_complete;
    }

    public function setAdresseComplete(string $adresse_complete): self
    {
        $this->adresse_complete = $adresse_complete;

        return $this;
    }

}
