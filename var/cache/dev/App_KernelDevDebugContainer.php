<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerJG5vRhR\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerJG5vRhR/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerJG5vRhR.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerJG5vRhR\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerJG5vRhR\App_KernelDevDebugContainer([
    'container.build_hash' => 'JG5vRhR',
    'container.build_id' => 'e8d55722',
    'container.build_time' => 1593538179,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerJG5vRhR');
