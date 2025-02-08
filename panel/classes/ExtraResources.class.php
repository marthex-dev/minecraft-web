<?php


class ExtraResources
{

    private $resources = array();
    private $type;

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    public function addResource($resource = null, $async = false, $defer = false)
    {
        array_push($this->resources, array(
            'url'   => $resource,
            'async' => $async,
            'defer' => $defer
        ));
    }

    public function getResources()
    {

        global $RabiwebVersion;

        if (!empty(array_filter($this->resources))) {
            foreach ($this->resources as $resource) {
                if ($this->type === 'css') {
                    echo '<link rel="stylesheet" href="'.$resource['url'].'?v='.$RabiwebVersion.'">';
                }
                else if ($this->type === 'js') {
                    echo '<script src="'.$resource['url'].'?v='.$RabiwebVersion.'" '.(($resource['async']) ? 'async' : null).' '.(($resource['defer']) ? 'defer' : null).'"></script>';
                }
                else if ($this->type === "script"){
                    echo "<script>".$resource['url']."</script>";
                }
                else {
                    return false;
                }
            }
        }
        else {
            return false;
        }
    }

}