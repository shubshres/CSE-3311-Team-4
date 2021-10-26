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

/* modules/geolocation/templates/geolocation-map-location.html.twig */
class __TwigTemplate_938dbddfb9aff9cdc3334ef7651024cb208149dfc3677ac50b10767052fa5caf extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 1, $this->source), "html", null, true);
        echo " typeof=\"Place\">
  <span property=\"geo\" typeof=\"GeoCoordinates\">
    <meta property=\"latitude\" content=\"";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["coordinates"] ?? null), "lat", [], "any", false, false, true, 3), 3, $this->source), "html", null, true);
        echo "\" />
    <meta property=\"longitude\" content=\"";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["coordinates"] ?? null), "lng", [], "any", false, false, true, 4), 4, $this->source), "html", null, true);
        echo "\" />
  </span>

  ";
        // line 7
        if ( !twig_test_empty(($context["title"] ?? null))) {
            // line 8
            echo "    <h2 class=\"location-title\" property=\"name\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 8, $this->source), "html", null, true);
            echo "</h2>
  ";
        }
        // line 10
        echo "
  ";
        // line 11
        if ( !twig_test_empty(($context["children"] ?? null))) {
            // line 12
            echo "    <div class=\"location-content\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 12, $this->source), "html", null, true);
            echo "</div>
  ";
        }
        // line 14
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "modules/geolocation/templates/geolocation-map-location.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 14,  68 => 12,  66 => 11,  63 => 10,  57 => 8,  55 => 7,  49 => 4,  45 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/geolocation/templates/geolocation-map-location.html.twig", "/home/sxs4805/public_html/modules/geolocation/templates/geolocation-map-location.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 7);
        static $filters = array("escape" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
