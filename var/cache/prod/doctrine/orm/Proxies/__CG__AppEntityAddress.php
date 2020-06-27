<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Address extends \App\Entity\Address implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'numero', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'suffixe', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'rue', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'code_postal', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'ville', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'complement'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'numero', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'suffixe', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'rue', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'code_postal', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'ville', '' . "\0" . 'App\\Entity\\Address' . "\0" . 'complement'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Address $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumero(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumero', []);

        return parent::getNumero();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumero(int $numero): \App\Entity\Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumero', [$numero]);

        return parent::setNumero($numero);
    }

    /**
     * {@inheritDoc}
     */
    public function getSuffixe(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSuffixe', []);

        return parent::getSuffixe();
    }

    /**
     * {@inheritDoc}
     */
    public function setSuffixe(?string $suffixe): \App\Entity\Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuffixe', [$suffixe]);

        return parent::setSuffixe($suffixe);
    }

    /**
     * {@inheritDoc}
     */
    public function getRue(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRue', []);

        return parent::getRue();
    }

    /**
     * {@inheritDoc}
     */
    public function setRue(string $rue): \App\Entity\Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRue', [$rue]);

        return parent::setRue($rue);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodePostal(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodePostal', []);

        return parent::getCodePostal();
    }

    /**
     * {@inheritDoc}
     */
    public function setCodePostal(int $code_postal): \App\Entity\Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodePostal', [$code_postal]);

        return parent::setCodePostal($code_postal);
    }

    /**
     * {@inheritDoc}
     */
    public function getVille(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVille', []);

        return parent::getVille();
    }

    /**
     * {@inheritDoc}
     */
    public function setVille(string $ville): \App\Entity\Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVille', [$ville]);

        return parent::setVille($ville);
    }

    /**
     * {@inheritDoc}
     */
    public function getComplement(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComplement', []);

        return parent::getComplement();
    }

    /**
     * {@inheritDoc}
     */
    public function setComplement(?string $complement): \App\Entity\Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setComplement', [$complement]);

        return parent::setComplement($complement);
    }

}
