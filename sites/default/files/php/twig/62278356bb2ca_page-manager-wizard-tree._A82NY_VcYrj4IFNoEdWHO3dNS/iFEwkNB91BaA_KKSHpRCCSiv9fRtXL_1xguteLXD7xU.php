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

/* modules/contrib/page_manager/page_manager_ui/templates/page-manager-wizard-tree.html.twig */
class __TwigTemplate_41fe366bd2493ea67163c8b9e00631ddff8c532b329eb04087d324bcbe71bd0a extends \Twig\Template
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
        // line 17
        echo "
";
        // line 18
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("page_manager_ui/page_variants"), "html", null, true);
        echo "

";
        // line 20
        $macros["page_manager"] = $this->macros["page_manager"] = $this;
        // line 21
        echo "
";
        // line 26
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["page_manager"], "macro_wizard_tree", [($context["tree"] ?? null), ($context["step"] ?? null), 0], 26, $context, $this->getSourceContext()));
        echo "

";
    }

    // line 28
    public function macro_wizard_tree($__items__ = null, $__step__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "step" => $__step__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 29
            echo "  ";
            $macros["page_manager"] = $this;
            // line 30
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 31
                echo "    <ul class=\"page__section__";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["menu_level"] ?? null), 31, $this->source), "html", null, true);
                echo "\">

    ";
                // line 33
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 34
                    echo "      ";
                    if ((($context["step"] ?? null) === twig_get_attribute($this->env, $this->source, $context["item"], "step", [], "any", false, false, true, 34))) {
                        // line 35
                        echo "        ";
                        $context["active_class"] = " current_variant";
                        // line 36
                        echo "      ";
                    } else {
                        // line 37
                        echo "        ";
                        $context["active_class"] = "";
                        // line 38
                        echo "      ";
                    }
                    // line 39
                    echo "      <li class=\"page__section_item__";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["menu_level"] ?? null), 39, $this->source), "html", null, true);
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["active_class"] ?? null), 39, $this->source), "html", null, true);
                    echo "\">
        <label class=\"page__section__label\">
          ";
                    // line 41
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 41)) {
                        // line 42
                        echo "            ";
                        if ((($context["step"] ?? null) === twig_get_attribute($this->env, $this->source, $context["item"], "step", [], "any", false, false, true, 42))) {
                            // line 43
                            echo "              <strong>";
                            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 43), 43, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 43), 43, $this->source)), "html", null, true);
                            echo "</strong>
            ";
                        } else {
                            // line 45
                            echo "              ";
                            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 45), 45, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 45), 45, $this->source)), "html", null, true);
                            echo "
            ";
                        }
                        // line 47
                        echo "          ";
                    } else {
                        // line 48
                        echo "            ";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 48), 48, $this->source), "html", null, true);
                        echo "
          ";
                    }
                    // line 50
                    echo "        </label>
        ";
                    // line 51
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "children", [], "any", false, false, true, 51)) {
                        // line 52
                        echo "          ";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["page_manager"], "macro_wizard_tree", [twig_get_attribute($this->env, $this->source, $context["item"], "children", [], "any", false, false, true, 52), ($context["step"] ?? null), (($context["menu_level"] ?? null) + 1)], 52, $context, $this->getSourceContext()));
                        echo "
        ";
                    }
                    // line 54
                    echo "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 56
                echo "    </ul>
  ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "modules/contrib/page_manager/page_manager_ui/templates/page-manager-wizard-tree.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 56,  149 => 54,  143 => 52,  141 => 51,  138 => 50,  132 => 48,  129 => 47,  123 => 45,  117 => 43,  114 => 42,  112 => 41,  105 => 39,  102 => 38,  99 => 37,  96 => 36,  93 => 35,  90 => 34,  86 => 33,  80 => 31,  77 => 30,  74 => 29,  59 => 28,  52 => 26,  49 => 21,  47 => 20,  42 => 18,  39 => 17,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/page_manager/page_manager_ui/templates/page-manager-wizard-tree.html.twig", "C:\\Training XAMPP\\htdocs\\drupal-standard-stage\\modules\\contrib\\page_manager\\page_manager_ui\\templates\\page-manager-wizard-tree.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("import" => 20, "macro" => 28, "if" => 30, "for" => 33, "set" => 35);
        static $filters = array("escape" => 18);
        static $functions = array("attach_library" => 18, "link" => 43);

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape'],
                ['attach_library', 'link']
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
