<?php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new FOS\CKEditorBundle\FOSCKEditorBundle(),
            // ...
        );

        // ...
    }
}