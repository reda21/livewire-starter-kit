# Système de gestion des rôles et permissions

Ce projet implémente un système de gestion des rôles et permissions sans utiliser Spatie Laravel Permission. Il inclut les fonctionnalités suivantes :

- Un modèle User, Role et Permission avec une relation many-to-many entre eux.
- Des Contracts et Traits pour gérer dynamiquement les permissions et rôles.
- Un middleware personnalisé pour vérifier les permissions avant d'accéder à certaines routes.
- Un panneau d'administration pour gérer les utilisateurs, rôles et permissions.
- Des Policies Laravel pour sécuriser les actions sensibles sur les ressources.
- Une interface utilisateur simple avec Bootstrap pour attribuer des rôles et permissions aux utilisateurs.
- Un système d'authentification basé sur Laravel Breeze ou Jetstream avec un tableau de bord pour les administrateurs et les utilisateurs.

## Ajout de nouveaux rôles et permissions

Pour ajouter de nouveaux rôles et permissions, suivez les étapes suivantes :

1. Créez un nouveau rôle en utilisant le formulaire de création de rôle dans le panneau d'administration. Vous pouvez spécifier le nom, le nom affiché et la description du rôle. Vous pouvez également sélectionner les permissions que vous souhaitez attribuer au rôle.

2. Créez une nouvelle permission en utilisant le formulaire de création de permission dans le panneau d'administration. Vous pouvez spécifier le nom, le nom affiché et la description de la permission.

3. Attribuez des rôles et permissions à un utilisateur en utilisant le formulaire d'attribution dans le panneau d'administration. Vous pouvez sélectionner les rôles et permissions que vous souhaitez attribuer à l'utilisateur.

## Documentation

Pour plus d'informations sur l'utilisation de ce système de gestion des rôles et permissions, consultez la documentation officielle de Laravel et les ressources suivantes :

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Breeze Documentation](https://laravel.com/docs/breeze)
- [Laravel Jetstream Documentation](https://laravel.com/docs/jetstream)
- [Laravel Policies Documentation](https://laravel.com/docs/authorization#policies)

N'hésitez pas à me contacter si vous avez des questions ou besoin d'aide supplémentaire.
