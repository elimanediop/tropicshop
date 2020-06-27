<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* home.html.twig */
class __TwigTemplate_a4f20d3dd9dba47ef94406f4b50495c9910ed84bf3b4422088324afaefcb8443 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!-- Page Content -->
<div class=\"container\">

    <div class=\"row\">
        <div class=\"col-lg-3\">
            <div class=\"section-heading my-4\">
                <h5>Categories</h5>
            </div>
            <div class=\"list-group\">
                <a href=\"fruits.php\" class=\"list-group-item\">Fruits</a>
                <a href=\"legumes.php\" class=\"list-group-item\">Légumes</a>
                <a href=\"epices.php\" class=\"list-group-item\">Condiments et Epices</a>
                <a href=\"cosmetiques.php\" class=\"list-group-item\">Cosmétiques</a>
                <a href=\"autres.php\" class=\"list-group-item\">Autres</a>
            </div>
            <div class=\"section-heading my-4\">
                <h5>Espace Clientèle</h5>
            </div>
            <div class=\"list-group\">
                <a href=\"fruits.php\" class=\"list-group-item\">Nos engagements</a>
                <a href=\"legumes.php\" class=\"list-group-item\">Avis Consommateur</a>
                <a href=\"epices.php\" class=\"list-group-item\">Nos partenaires</a>
                <a href=\"cosmetiques.php\" class=\"list-group-item\">Qui sommes-nous</a>
                <a href=\"contact.html\" class=\"list-group-item\">Contact</a>
            </div>
            <div class=\"single-sidebar-widget my-4\">
                <video src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vid/video1.mp4"), "html", null, true);
        echo "\" class=\"add-img\" controls poster=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/recette.png"), "html", null, true);
        echo "\">
                    Cette vidéo ne peut être affichée sur votre navigateur Internet.<br>
                    Une version est disponible en téléchargement sous <a href=\"URL\">adresse du lien </a> .
                </video>
            </div>
            <div class=\"post-meta\">
                <a href=\"https://instagram.com/saveurs_afrique?=nametag\" class=\"post-title\" target=\"_blank\">Plus de détails...</a>
            </div>
            <!-- Sidebar Widget -->
            <div class=\"single-sidebar-widget  my-4\">
                <a href=\"#\" class=\"add-img\" target=\"_blank\"><img src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/51.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
            </div>
            <!-- Sidebar Widget -->
            <div class=\"single-sidebar-widget  my-4\">
                <a href=\"#\" class=\"add-img\" target=\"_blank\"><img src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/72.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
            </div>
            <!-- Sidebar Widget -->
            <div class=\"single-sidebar-widget  my-4\">
                <a href=\"#\" class=\"add-img\" target=\"_blank\"><img src=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/71.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
            </div>

        </div>
        <!-- /.col-lg-3 -->


        <div class=\"col-lg-9\">

            <div id=\"carouselExampleIndicators\" class=\"carousel slide my-4\" data-ride=\"carousel\">
                <ol class=\"carousel-indicators\">
                    <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"0\" class=\"active\"></li>
                    <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"1\"></li>
                    <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"2\"></li>
                </ol>
                <div class=\"carousel-inner\" role=\"listbox\">
                    <div class=\"carousel-item active\">
                        <img class=\"d-block img-fluid\" src=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider1.jpg"), "html", null, true);
        echo "\" alt=\"First slide\">
                    </div>
                    <div class=\"carousel-item\">
                        <img class=\"d-block img-fluid\" src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider2.jpg"), "html", null, true);
        echo "\" alt=\"Second slide\">
                    </div>
                    <div class=\"carousel-item\">
                        <img class=\"d-block img-fluid\" src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider3.jpg"), "html", null, true);
        echo "\" alt=\"Third slide\">
                    </div>
                    <div class=\"carousel-item\">
                        <img class=\"d-block img-fluid\" src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider4.jpg"), "html", null, true);
        echo "\" alt=\"Third slide\">
                    </div>
                    <div class=\"carousel-item\">
                        <img class=\"d-block img-fluid\" src=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider5.jpg"), "html", null, true);
        echo "\" alt=\"Third slide\">
                    </div>
                </div>
                <a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\">
                    <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Previous</span>
                </a>
                <a class=\"carousel-control-next\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\">
                    <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Next</span>
                </a>
            </div>

            <div class=\"row\">

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/1.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Patate douce violette</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$5.99</h5>
                            <p class=\"card-text\">Cette patate douce est parfumée et un peu plus sucrée que la patate douce orange.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 104
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/2.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Banane</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$2.99</h5>
                            <p class=\"card-text\">Fruit riche en fer, en manganèse, en vitamine B et en potassium, la banane est également transformée pour obtenir des chips qui peuvent servir d’amuse-gueules pour vos apéros</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 117
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/3.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Piment</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$2.99</h5>
                            <p class=\"card-text\">Le piment est un ingrédient très utilisé dans la cuisine africaine et antillaise. Il est riche en vitamines C, E, B6 et en fer manganèse, cuivre.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 130
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/4.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Patate douce</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$4.99</h5>
                            <p class=\"card-text\">La patate douce est un tubercule qui renferme de l’amidon, ainsi que des nutriments tels que le manganèse, le cuivre, les vitamines B6, B2, C et A.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 143
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/5.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Mangue</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$3.99</h5>
                            <p class=\"card-text\">La mangue est un fruit parfumé aux saveurs délicieuses et à la chaire juteuse. Elle est riche en vitamine C.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/6.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Arôme Maggi</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$6.99</h5>
                            <p class=\"card-text\">L’arôme Maggi est utilisé pour l’assaisonnement des plats.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 169
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/7.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Huile de palme</a>
                            </h4>
                            <h5 style=\"color:#f5bd4c;\">\$4.99</h5>
                            <p class=\"card-text\">Issue de la transformation, l’huile de palme s’utilise dans la préparation de sauces comme la sauce gombo ou la sauce de corètes potagères.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 182
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/48.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Gingembre</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$0.99</h5>
                            <p class=\"card-text\">Loin d'être un simple stimulant sexuel, le gingembre est aussi d'un brûle graisse naturel. Cet épice aide à la digestion et très utilisé dans la cuisine africaine, asiatique et indienne.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 195
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/9.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Pâte d’arachide</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$7.99</h5>
                            <p class=\"card-text\">: La pâte d’arachide est utilisée pour la préparation de la sauce d’arachide.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 208
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/10.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Gombo</a>
                            </h4>
                            <h5  style=\"color:#f5bd4c;\">\$0.99</h5>
                            <p class=\"card-text\">Utilisé comme légume ou condiment, le gombo est consommé dans la quasi-totalité de l'Afrique tout au long de l'année. La sauce de gombo est la plus prisée.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 221
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/11.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Papaye</a>
                            </h4>
                            <h5 style=\"color:#f5bd4c;\">\$9</h5>
                            <p class=\"card-text\">La papaye est un fruit gorgé de vitamines, excellent pour le tonus.</p>
                        </div>
                    </div>
                </div>

                <div class=\"col-lg-4 col-md-6 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 234
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/12.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"#\">Bissap</a>
                            </h4>
                            <h5 style=\"color:#f5bd4c;\">\$7.5</h5>
                            <p class=\"card-text\">Feuilles d’hibiscus séchées. On obtient le jus de bissap par ébuilition de feuilles séchées. </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
        <!-- /.container -->";
    }

    public function getTemplateName()
    {
        return "home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  334 => 234,  318 => 221,  302 => 208,  286 => 195,  270 => 182,  254 => 169,  238 => 156,  222 => 143,  206 => 130,  190 => 117,  174 => 104,  158 => 91,  138 => 74,  132 => 71,  126 => 68,  120 => 65,  114 => 62,  94 => 45,  87 => 41,  80 => 37,  65 => 27,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "home.html.twig", "C:\\Users\\user\\Desktop\\projet tropicshop\\codes sources\\version_1\\tropicshop\\templates\\home.html.twig");
    }
}
