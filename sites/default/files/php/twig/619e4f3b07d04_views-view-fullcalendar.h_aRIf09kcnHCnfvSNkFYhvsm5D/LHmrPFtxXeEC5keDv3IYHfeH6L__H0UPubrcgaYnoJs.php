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

/* modules/fullcalendar_view/templates/views-view-fullcalendar.html.twig */
class __TwigTemplate_7aa23b0c30c15d7aa93375525c632cda5bdd871c284b34c47098f96a5cc0c5a3 extends \Twig\Template
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
        // line 18
        $context["classes"] = [0 => twig_get_attribute($this->env, $this->source,         // line 19
($context["options"] ?? null), "classes", [], "any", false, false, true, 19)];
        // line 22
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 22), 22, $this->source), "html", null, true);
        echo ">
  <div class=\"js-drupal-fullcalendar\"></div>
  <div id=\"bottom-buttons fc-button-group\">
    ";
        // line 25
        if (($context["showAddEvent"] ?? null)) {
            // line 26
            echo "    <div class=\"fullcalendar-bottom-btn add-event-btn\">
        <a id=\"calendar-add-event\"  href=\"";
            // line 27
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["language"] ?? null), 27, $this->source), "html", null, true);
            echo "fullcalendar-view-event-add?entity=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["entity_id"] ?? null), 27, $this->source), "html", null, true);
            echo "&bundle=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "bundle_type", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
            echo "&start_field=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "start", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
            echo "&end_field=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "end", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
            echo "&destination=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<current>"));
            echo "\" class=\"use-ajax\" data-dialog-type=\"dialog\" data-dialog-renderer=\"off_canvas\" 
   data-dialog-options=\"{&quot;width&quot;:400}\">";
            // line 28
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Add event"));
            echo "</a>
    </div>
    ";
        }
        // line 31
        echo "    <div class=\"fullcalendar-bottom-btn locale-selector\">
      <label for=\"locale-selector\">";
        // line 32
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Select Language:"));
        echo "</label>
      <select id='locale-selector'></select>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/fullcalendar_view/templates/views-view-fullcalendar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 32,  74 => 31,  68 => 28,  54 => 27,  51 => 26,  49 => 25,  42 => 22,  40 => 19,  39 => 18,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/fullcalendar_view/templates/views-view-fullcalendar.html.twig", "/home/sxs4805/public_html/modules/fullcalendar_view/templates/views-view-fullcalendar.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 18, "if" => 25);
        static $filters = array("escape" => 22, "t" => 28);
        static $functions = array("path" => 27);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 't'],
                ['path']
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
