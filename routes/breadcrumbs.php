<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use Illuminate\Support\Str;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// HRD - Employes
Breadcrumbs::for('hrd.employes', function (BreadcrumbTrail $trail) {
    $trail->push('Employes', route('employes.index'));
});

Breadcrumbs::for('hrd.employes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('hrd.employes');
    $trail->push('Create', route('employes.create'));
});

Breadcrumbs::for('hrd.employes.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('hrd.employes');
    $trail->push(Str::slug($employee->fullname()), route('employes.edit', $employee->id));
});

Breadcrumbs::for('hrd.employes.actived', function (BreadcrumbTrail $trail) {
    $trail->parent('hrd.employes');
    $trail->push('Actived', route('employes.actived'));
});

///

Breadcrumbs::for('hrd.employes.annualeave', function (BreadcrumbTrail $trail) {
    $trail->push('Annual of Leave Employes', route('annualeave.index'));
});

// // Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });
