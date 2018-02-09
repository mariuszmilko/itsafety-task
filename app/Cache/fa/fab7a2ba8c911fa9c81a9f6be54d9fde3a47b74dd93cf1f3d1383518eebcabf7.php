<?php

/* day.report */
class __TwigTemplate_50d2879e2ef7131d1475836ae80e2b32eb22cf33de77fd49678a61b127523748 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "Raport Track  dla Device: ";
        echo twig_escape_filter($this->env, ($context["deviceId"] ?? null), "html", null, true);
        echo "   dzień: ";
        echo twig_escape_filter($this->env, ($context["day"] ?? null), "html", null, true);
        echo "

=========================================================================== 
";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["device"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["tracks"]) {
            // line 5
            echo "     No.: ";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "

  ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["tracks"]);
            foreach ($context['_seq'] as $context["key"] => $context["track"]) {
                // line 8
                echo " Typ: ";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "
      ";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["track"]);
                foreach ($context['_seq'] as $context["key"] => $context["parameter"]) {
                    // line 10
                    echo "Parametr: ";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "
            ";
                    // line 11
                    echo twig_var_dump($this->env, $context, $context["parameter"]);
                    echo "
--------------------------------------------------------------------------
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['parameter'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 14
                echo "
--------------------------------------------------------------------------      
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['track'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "========================================================================== 
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['tracks'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "

Raport Track  dla Device: ";
        // line 21
        echo twig_escape_filter($this->env, ($context["deviceId"] ?? null), "html", null, true);
        echo "   dzień: ";
        echo twig_escape_filter($this->env, ($context["day"] ?? null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "day.report";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 21,  80 => 19,  73 => 17,  65 => 14,  56 => 11,  51 => 10,  47 => 9,  42 => 8,  38 => 7,  32 => 5,  28 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("Raport Track  dla Device: {{ deviceId }}   dzień: {{ day }}

=========================================================================== 
{% for key, tracks in device %}
     No.: {{ key }}

  {% for key, track in tracks %}
 Typ: {{ key }}
      {% for key, parameter in track %}
Parametr: {{ key }}
            {{dump(parameter)}}
--------------------------------------------------------------------------
      {% endfor %}

--------------------------------------------------------------------------      
  {% endfor %}
========================================================================== 
{% endfor %}


Raport Track  dla Device: {{ deviceId }}   dzień: {{ day }}
", "day.report", "/var/www/app/src/Reports/Sheets/Tracks/Reports/Documents/day.report");
    }
}
