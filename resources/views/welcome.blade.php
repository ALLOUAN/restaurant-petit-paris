<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Restaurant Petit Paris — cuisine française, produits de saison et ambiance chaleureuse.">

        <title>{{ config('app.name', 'Restaurant Petit Paris') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cormorant-garamond:500,600,700|instrument-sans:400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            fontFamily: {
                                sans: ['"Instrument Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                                display: ['"Cormorant Garamond"', 'ui-serif', 'Georgia', 'serif'],
                            },
                        },
                    },
                };
            </script>
        @endif

        <style>
            :where(html) {
                font-family: "Instrument Sans", ui-sans-serif, system-ui, sans-serif;
            }
        </style>
    </head>
    <body class="min-h-screen bg-stone-50 text-stone-900 antialiased">
        @if (Route::has('login'))
            <div class="border-b border-stone-200/80 bg-white/90 backdrop-blur-sm">
                <div class="mx-auto flex max-w-6xl items-center justify-end gap-3 px-4 py-2 text-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-lg border border-stone-200 px-4 py-1.5 text-stone-700 transition hover:border-stone-300 hover:bg-stone-50">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-1.5 text-stone-600 transition hover:text-stone-900">
                            Connexion
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-lg border border-stone-200 px-4 py-1.5 text-stone-700 transition hover:border-stone-300 hover:bg-stone-50">
                                Inscription
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        @endif

        <header class="border-b border-stone-200/80 bg-white/80 backdrop-blur-md">
            <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-6 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ url('/') }}" class="group inline-flex items-baseline gap-2">
                    <span class="font-display text-2xl font-semibold tracking-tight text-stone-900 transition group-hover:text-amber-800">
                        Petit Paris
                    </span>
                    <span class="hidden text-xs font-medium uppercase tracking-[0.2em] text-amber-800/90 sm:inline">
                        Restaurant
                    </span>
                </a>
                <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm font-medium text-stone-600">
                    <a href="#carte" class="transition hover:text-stone-900">La carte</a>
                    <a href="#ambiance" class="transition hover:text-stone-900">L’expérience</a>
                    <a href="#horaires" class="transition hover:text-stone-900">Horaires</a>
                    <a href="#contact" class="transition hover:text-stone-900">Contact</a>
                </nav>
            </div>
        </header>

        <main>
            <section class="relative overflow-hidden border-b border-stone-200/80 bg-gradient-to-b from-amber-50/90 via-stone-50 to-stone-50">
                <div class="pointer-events-none absolute -right-24 top-0 h-96 w-96 rounded-full bg-amber-200/30 blur-3xl" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -left-32 bottom-0 h-80 w-80 rounded-full bg-red-900/5 blur-3xl" aria-hidden="true"></div>

                <div class="relative mx-auto max-w-6xl px-4 py-16 sm:py-24 lg:py-28">
                    <div class="max-w-2xl">
                        <p class="text-sm font-semibold uppercase tracking-widest text-amber-900/80">
                            Bienvenue
                        </p>
                        <h1 class="mt-4 font-display text-4xl font-semibold leading-tight text-stone-900 sm:text-5xl lg:text-6xl">
                            Une table française, tout en délicatesse
                        </h1>
                        <p class="mt-6 text-lg leading-relaxed text-stone-600">
                            Classics du bistrot, sauces au bon goût de mijoté, desserts maison et une cave modeste mais sincère.
                            Ici, on prend le temps — comme à Paris.
                        </p>
                        <div class="mt-10 flex flex-wrap items-center gap-4">
                            <a
                                href="#contact"
                                class="inline-flex items-center justify-center rounded-xl bg-stone-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-stone-800"
                            >
                                Réserver une table
                            </a>
                            <a
                                href="#carte"
                                class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white px-6 py-3 text-sm font-semibold text-stone-800 transition hover:border-stone-400 hover:bg-stone-50"
                            >
                                Voir la carte
                            </a>
                        </div>
                        <dl class="mt-12 grid gap-6 sm:grid-cols-3">
                            <div class="rounded-2xl border border-stone-200/80 bg-white/70 p-5 shadow-sm backdrop-blur-sm">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-stone-500">Midi & soir</dt>
                                <dd class="mt-1 text-sm font-medium text-stone-800">Service continu le week-end</dd>
                            </div>
                            <div class="rounded-2xl border border-stone-200/80 bg-white/70 p-5 shadow-sm backdrop-blur-sm">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-stone-500">Saison</dt>
                                <dd class="mt-1 text-sm font-medium text-stone-800">Carte renouvelée chaque mois</dd>
                            </div>
                            <div class="rounded-2xl border border-stone-200/80 bg-white/70 p-5 shadow-sm backdrop-blur-sm">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-stone-500">Accueil</dt>
                                <dd class="mt-1 text-sm font-medium text-stone-800">Familles & petits groupes</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>

            <section id="ambiance" class="border-b border-stone-200/80 bg-white">
                <div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
                    <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                        <div>
                            <h2 class="font-display text-3xl font-semibold text-stone-900 sm:text-4xl">
                                L’esprit d’un bistrot parisien
                            </h2>
                            <p class="mt-4 leading-relaxed text-stone-600">
                                Boiseries chaudes, lumière tamisée, ardoise du jour au mur et le bruit doux des couverts.
                                Nous aimons les produits simples bien travaillés : beurre, herbes, jus de viande réduits avec patience.
                            </p>
                            <ul class="mt-8 space-y-3 text-stone-600">
                                <li class="flex gap-3">
                                    <span class="mt-1.5 inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-amber-700" aria-hidden="true"></span>
                                    <span>Viandes et poissons issus de filières que nous connaissons.</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="mt-1.5 inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-amber-700" aria-hidden="true"></span>
                                    <span>Pain, glaces et pâtisseries préparés sur place.</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="mt-1.5 inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-amber-700" aria-hidden="true"></span>
                                    <span>Allergies, offres végétariennes et enfants : dites-nous vos besoins.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-stone-200 bg-stone-50 p-6 shadow-sm">
                                <p class="font-display text-xl font-semibold text-stone-900">Formule déjeuner</p>
                                <p class="mt-2 text-sm leading-relaxed text-stone-600">
                                    Entrée + plat ou plat + dessert, café inclus en semaine.
                                </p>
                            </div>
                            <div class="rounded-2xl border border-stone-200 bg-stone-900 p-6 text-white shadow-sm sm:translate-y-4">
                                <p class="font-display text-xl font-semibold">Menu du soir</p>
                                <p class="mt-2 text-sm leading-relaxed text-stone-300">
                                    Quatre services au choix, accord mets et vins sur demande.
                                </p>
                            </div>
                            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:col-span-2">
                                <p class="text-sm font-semibold text-stone-900">Privatisation</p>
                                <p class="mt-1 text-sm text-stone-600">
                                    Le salon peut accueillir jusqu’à 24 convives pour un dîner sur-mesure.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="carte" class="border-b border-stone-200/80 bg-stone-50">
                <div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
                    <div class="max-w-2xl">
                        <h2 class="font-display text-3xl font-semibold text-stone-900 sm:text-4xl">Un avant-goût de la carte</h2>
                        <p class="mt-3 text-stone-600">
                            Quelques signatures — la carte complète s’ajuste au marché.
                        </p>
                    </div>

                    <div class="mt-12 grid gap-6 md:grid-cols-3">
                        <article class="flex flex-col rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-amber-900/80">Pour commencer</h3>
                            <ul class="mt-4 space-y-4 text-sm text-stone-600">
                                <li class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                    <span>Oeuf mollet, mousseline de petits pois</span>
                                </li>
                                <li class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                    <span>Terrine de campagne, cornichons & pain de méteil</span>
                                </li>
                                <li class="flex justify-between gap-4">
                                    <span>Soupe à l’oignon gratinée</span>
                                </li>
                            </ul>
                        </article>

                        <article class="flex flex-col rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:shadow-md md:-translate-y-2">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-amber-900/80">Au centre de l’assiette</h3>
                            <ul class="mt-4 space-y-4 text-sm text-stone-600">
                                <li class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                    <span>Blanquette de veau, riz pilaf & carottes glacées</span>
                                </li>
                                <li class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                    <span>Poisson du jour, beurre blanc citronné</span>
                                </li>
                                <li class="flex justify-between gap-4">
                                    <span>Steak frites, sauce au poivre</span>
                                </li>
                            </ul>
                        </article>

                        <article class="flex flex-col rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-amber-900/80">Pour finir</h3>
                            <ul class="mt-4 space-y-4 text-sm text-stone-600">
                                <li class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                    <span>Profiteroles, sauce chocolat chaude</span>
                                </li>
                                <li class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                    <span>Tarte citron meringuée</span>
                                </li>
                                <li class="flex justify-between gap-4">
                                    <span>Assortiment de fromages affinés</span>
                                </li>
                            </ul>
                        </article>
                    </div>
                </div>
            </section>

            <section class="border-b border-stone-200/80 bg-white">
                <div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
                    <h2 class="font-display text-3xl font-semibold text-stone-900 sm:text-4xl">Ils en parlent</h2>
                    <div class="mt-10 grid gap-6 md:grid-cols-2">
                        <blockquote class="rounded-2xl border border-stone-200 bg-stone-50 p-8">
                            <p class="text-stone-700 leading-relaxed">
                                « Une adresse sincère : portions généreuses, sauce bistrot comme il faut, et un service qui sourit sans forcer.
                                On se croirait rue du Faubourg. »
                            </p>
                            <footer class="mt-6 text-sm font-medium text-stone-500">— <cite>Le Quotidien gourmand</cite></footer>
                        </blockquote>
                        <blockquote class="rounded-2xl border border-stone-200 bg-stone-50 p-8">
                            <p class="text-stone-700 leading-relaxed">
                                « Le menu du jour est une valeur sûre ; le pain et le beurre se suffisent presque à eux seuls. »
                            </p>
                            <footer class="mt-6 text-sm font-medium text-stone-500">— <cite>Chroniques locales</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </section>

            <section id="horaires" class="border-b border-stone-200/80 bg-stone-50">
                <div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
                    <div class="grid gap-10 lg:grid-cols-2">
                        <div>
                            <h2 class="font-display text-3xl font-semibold text-stone-900 sm:text-4xl">Horaires & accès</h2>
                            <p class="mt-3 text-stone-600">
                                Remplacez l’adresse et les horaires par les vôtres — la structure est prête.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-stone-200 bg-white p-8 shadow-sm">
                            <dl class="space-y-4 text-sm">
                                <div class="flex justify-between gap-4 border-b border-stone-100 pb-4">
                                    <dt class="font-medium text-stone-800">Mardi — Jeudi</dt>
                                    <dd class="text-right text-stone-600">12h — 14h30 · 19h — 22h</dd>
                                </div>
                                <div class="flex justify-between gap-4 border-b border-stone-100 pb-4">
                                    <dt class="font-medium text-stone-800">Vendredi — Samedi</dt>
                                    <dd class="text-right text-stone-600">12h — 15h · 19h — 23h</dd>
                                </div>
                                <div class="flex justify-between gap-4 border-b border-stone-100 pb-4">
                                    <dt class="font-medium text-stone-800">Dimanche</dt>
                                    <dd class="text-right text-stone-600">12h — 15h</dd>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <dt class="font-medium text-stone-800">Lundi</dt>
                                    <dd class="text-right text-stone-600">Fermé</dd>
                                </div>
                            </dl>
                            <p class="mt-6 text-sm text-stone-600">
                                <strong class="text-stone-800">Adresse :</strong> 00 Rue Exemple, 75000 Ville
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="contact" class="bg-stone-900 text-stone-100">
                <div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
                    <div class="grid gap-10 lg:grid-cols-2 lg:items-end">
                        <div>
                            <h2 class="font-display text-3xl font-semibold text-white sm:text-4xl">
                                Une table à votre nom&nbsp;?
                            </h2>
                            <p class="mt-4 max-w-md text-stone-300">
                                Appelez-nous ou écrivez-nous : nous répondons vite pour les réservations et les petits événements.
                            </p>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-end">
                            <a
                                href="tel:+33100000000"
                                class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-stone-900 transition hover:bg-stone-100"
                            >
                                Appeler le restaurant
                            </a>
                            <a
                                href="mailto:contact@petitparis.example"
                                class="inline-flex items-center justify-center rounded-xl border border-stone-600 px-6 py-3 text-sm font-semibold text-white transition hover:border-stone-400 hover:bg-stone-800"
                            >
                                Écrire un e-mail
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-stone-800 bg-stone-950 py-8 text-center text-xs text-stone-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Restaurant Petit Paris') }}. Tous droits réservés.</p>
        </footer>
    </body>
</html>
