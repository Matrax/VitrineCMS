<?php

declare(strict_types = 1);

/**
 * Classe utilitaire qui contient quelques fonctions pour récupérer des informations
 * sur des classes et d'invoquer certaines méthodes des conteneurs HTML.
 * @brief Classe utilitaire pour les classes PHP.
 * @author Alexandre Pierret
 * @version 1.0
 */
class ClassUtils
{

    /**
     * Cette fonction renvoie des informations sur la classe qui correspond au type passé en paramètre.
     * Le type correspond à la métadonnée @type écrit dans la classe.
     * @param string $type Le type indiquer dans la balise type de la classe.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function getClassWithType(string $type) : ?ReflectionClass
    {
        $directory = array_diff(scandir("php/containers", SCANDIR_SORT_NONE), [".", ".."]);
        $annotations = array();
        foreach($directory as $key => $value)
        {
            $name = str_replace(".php", "", $value);
            $found = new ReflectionClass($name);
            $comment = $found->getDocComment();
            if($comment == true) 
            {
                preg_match_all("#@(.*?)\n#s", $comment, $annotations);
                $class = chop(substr($annotations[0][0], 6), PHP_EOL);
                if($class == $type) return $found;
            }
        }
        return null;
    }

    /**
     * Cette fonction permet de récuperer sous forme de liste toutes les classes conteneurs HTML.
     * Le tableau va contenir le nom de ces classes.
     * @return array toutes les classes conteneurs HTML sous forme de liste.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function getAllContainerClasses() : array
    {
        $directory = array_diff(scandir("php/containers", SCANDIR_SORT_NONE), [".", ".."]);
        $containers = array();
        foreach ($directory as $key => $value) 
        {
            $name = str_replace(".php", "", $value);
            array_push($containers, $name);
        }
        return $containers;
    }
    
    /**
     * Cette fonction permet d'invoquer une méthode static d'une classe
     * indiqué en paramètre avec les paramètre de la fonction static indiqué.
     * @param ReflectionClass $class La classe ou se situe la méthode static.
     * @param string $method Le nom de la méthode static à invoquer.
     * @param array $data Le tableau contenant les paramètres de la méthode static.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function invokeStaticMethod(ReflectionClass $class, string $method, mixed $data) : mixed
    {
        $methods = $class->getMethods(ReflectionMethod::IS_STATIC);
        foreach ($methods as $key => $value) 
        {
            if($value->getName() == $method)
            {
                return $value->invoke(null, $data);
            }
        }
        return null;
    }
}

