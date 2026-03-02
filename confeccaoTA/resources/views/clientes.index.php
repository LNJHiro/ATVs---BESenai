{{-- resources/views/index.blade.php --}}
<!doctype html>
<html lang="pt-BR" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Confecção') }}</title>

    {{-- Tailwind via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="description" content="Sistema moderno para gestão de confecção: pedidos, produção, estoque e clientes.">
</head>

<body class="h-full bg-slate-950 text-slate-100 antialiased">
    {{-- Background decor --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 left-1/2 h-[36rem] w-[36rem] -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute -bottom-40 right-[-10rem] h-[30rem] w-[30rem] rounded-full bg-fuchsia-500/15 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(99,102,241,0.15),transparent_55%),radial-gradient(circle_at_bottom,rgba(236,72,153,0.12),transparent_55%)]"></div>
    </div>

    <div class="relative min-h-full">
        {{-- Top Bar --}}
        <header class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/60 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ url('/') }}" class="group inline-flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/10 ring-1 ring-white/15">
                        <span class="text-lg">🧵</span>
                    </span>
                    <div class="leading-tight">
                        <div class="text-base font-semibold tracking-tight text-white">
                            {{ config('app.name', 'Confecção') }}
                        </div>
                        <div class="text-xs text-slate-300/80">Gestão e produção com visual premium</div>
                    </div>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a href="#recursos" class="rounded-lg px-3 py-2 text-sm text-slate-200/90 hover:bg-white/5 hover:text-white">Recursos</a>
                    <a href="#modelos" class="rounded-lg px-3 py-2 text-sm text-slate-200/90 hover:bg-white/5 hover:text-white">Modelos</a>
                    <a href="#depoimentos" class="rounded-lg px-3 py-2 text-sm text-slate-200/90 hover:bg-white/5 hover:text-white">Depoimentos</a>
                    <a href="#contato" class="rounded-lg px-3 py-2 text-sm text-slate-200/90 hover:bg-white/5 hover:text-white">Contato</a>
                </nav>

                <div class="flex items-center gap-2">
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 text-sm font-medium text-white ring-1 ring-white/15 hover:bg-white/15">
                        Ir para o painel
                        <svg class="h-4 w-4 opacity-80" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69l-3.22-3.22a.75.75 0 1 1 1.06-1.06l4.5 4.5c.3.3.3.77 0 1.06l-4.5 4.5a.75.75 0 1 1-1.06-1.06l3.22-3.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="rounded-xl bg-white/10 px-4 py-2 text-sm font-medium text-white ring-1 ring-white/15 hover:bg-white/15">
                        Entrar
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-xl bg-gradient-to-r from-indigo-500 to-fuchsia-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 hover:brightness-110">
                        Criar conta
                    </a>
                    @endif
                    @endauth
                </div>
            </div>
        </header>

        <main>
            {{-- Hero --}}
            <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8 lg:pt-20">
                <div class="grid items-center gap-10 lg:grid-cols-2">
                    <div>
                        <p class="inline-flex items-center gap-2 rounded-full bg-white/5 px-4 py-2 text-xs font-medium text-slate-200 ring-1 ring-white/10">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_20px_rgba(52,211,153,0.7)]"></span>
                            Sistema pronto para produção • Laravel + Tailwind
                        </p>

                        <h1 class="mt-6 text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                            Um <span class="bg-gradient-to-r from-indigo-300 via-indigo-200 to-fuchsia-200 bg-clip-text text-transparent">painel moderno</span>
                            para sua confecção, do pedido à entrega.
                        </h1>

                        <p class="mt-5 text-base leading-relaxed text-slate-300 sm:text-lg">
                            Controle pedidos, clientes, estoque e etapas da produção com um visual limpo, rápido e profissional.
                            Feito para escalar — bonito por padrão.
                        </p>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-fuchsia-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:brightness-110">
                                Acessar painel
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69l-3.22-3.22a.75.75 0 1 1 1.06-1.06l4.5 4.5c.3.3.3.77 0 1.06l-4.5 4.5a.75.75 0 1 1-1.06-1.06l3.22-3.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            <a href="#recursos"
                                class="inline-flex items-center gap-2 rounded-xl bg-white/5 px-5 py-3 text-sm font-semibold text-white ring-1 ring-white/10 hover:bg-white/10">
                                Ver recursos
                            </a>

                            <div class="flex items-center gap-3 pl-1 text-xs text-slate-300/90">
                                <div class="flex -space-x-2">
                                    <div class="h-7 w-7 rounded-full bg-white/10 ring-1 ring-white/10"></div>
                                    <div class="h-7 w-7 rounded-full bg-white/10 ring-1 ring-white/10"></div>
                                    <div class="h-7 w-7 rounded-full bg-white/10 ring-1 ring-white/10"></div>
                                </div>
                                <span><span class="text-white/90 font-semibold">+120</span> operações organizadas</span>
                            </div>
                        </div>

                        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <div class="text-sm font-semibold text-white">Pedidos</div>
                                <div class="mt-1 text-xs text-slate-300">orçamento → produção</div>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <div class="text-sm font-semibold text-white">Estoque</div>
                                <div class="mt-1 text-xs text-slate-300">insumos e saídas</div>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10 sm:col-span-1 col-span-2">
                                <div class="text-sm font-semibold text-white">Relatórios</div>
                                <div class="mt-1 text-xs text-slate-300">margem, prazos, gargalos</div>
                            </div>
                        </div>
                    </div>

                    {{-- Showcase card --}}
                    <div class="relative">
                        <div class="absolute -inset-2 rounded-3xl bg-gradient-to-r from-indigo-500/20 to-fuchsia-500/20 blur-2xl"></div>

                        <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl">
                            <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="h-2.5 w-2.5 rounded-full bg-rose-400/80"></span>
                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-300/80"></span>
                                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-300/80"></span>
                                </div>
                                <div class="text-xs text-slate-300/80">Visão geral</div>
                            </div>

                            <div class="p-6">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <div class="text-sm font-semibold text-white">Produção hoje</div>
                                        <div class="mt-1 text-xs text-slate-300">Acompanhe etapas e prazos</div>
                                    </div>
                                    <span class="rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold text-emerald-200 ring-1 ring-emerald-500/25">
                                        Operando
                                    </span>
                                </div>

                                <div class="mt-6 grid gap-3">
                                    @php
                                    $items = [
                                    ['OP #1281', 'Corte', '70%'],
                                    ['OP #1282', 'Costura', '40%'],
                                    ['OP #1283', 'Acabamento', '90%'],
                                    ];
                                    @endphp

                                    @foreach($items as [$op, $fase, $pct])
                                    <div class="rounded-2xl bg-slate-950/40 p-4 ring-1 ring-white/10">
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm font-semibold text-white">{{ $op }}</div>
                                            <div class="text-xs text-slate-300">{{ $fase }}</div>
                                        </div>
                                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-white/5">
                                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-400 to-fuchsia-400"
                                                @style(["width: {$pct}"])></div>
                                        </div>
                                        <div class="mt-2 text-right text-xs text-slate-300">{{ $pct }}</div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 grid grid-cols-2 gap-3">
                                    <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                        <div class="text-xs text-slate-300">Entregas hoje</div>
                                        <div class="mt-1 text-2xl font-semibold text-white">8</div>
                                    </div>
                                    <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                        <div class="text-xs text-slate-300">Pendências</div>
                                        <div class="mt-1 text-2xl font-semibold text-white">3</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="mt-4 text-center text-xs text-slate-400">
                            Interface exemplo • personalize com seus módulos
                        </p>
                    </div>
                </div>
            </section>

            {{-- Features --}}
            <section id="recursos" class="mx-auto mt-20 max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between gap-6">
                    <div>
                        <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Recursos que deixam tudo organizado</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-300">
                            Estrutura pronta para você evoluir: cadastro, fluxo, indicadores e telas com padrão consistente.
                        </p>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @php
                    $features = [
                    ['📦', 'Estoque inteligente', 'Controle de entradas/saídas, alerta de mínimo e histórico por item.'],
                    ['🧾', 'Pedidos e orçamentos', 'Crie pedidos, acompanhe status, prazos e valores em um fluxo claro.'],
                    ['🏭', 'Etapas da produção', 'Corte, costura, acabamento e inspeção com progresso e responsáveis.'],
                    ['👥', 'Clientes e fornecedores', 'Cadastro completo, contatos, observações e última movimentação.'],
                    ['📊', 'Indicadores', 'Visão rápida de entregas, pendências, produtividade e gargalos.'],
                    ['🔒', 'Acesso por perfil', 'Usuários, permissões e trilha de auditoria para mudanças importantes.'],
                    ];
                    @endphp

                    @foreach($features as [$icon, $title, $desc])
                    <div class="group rounded-3xl border border-white/10 bg-white/5 p-6 shadow-[0_1px_0_rgba(255,255,255,0.06)] transition hover:bg-white/7">
                        <div class="flex items-center gap-3">
                            <div class="grid h-11 w-11 place-items-center rounded-2xl bg-white/10 ring-1 ring-white/10">
                                <span class="text-lg">{{ $icon }}</span>
                            </div>
                            <h3 class="text-base font-semibold text-white">{{ $title }}</h3>
                        </div>
                        <p class="mt-4 text-sm leading-relaxed text-slate-300">{{ $desc }}</p>
                        <div class="mt-5 h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                        <p class="mt-4 text-xs text-slate-400">
                            Pronto para integrar com seus Controllers e Models.
                        </p>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Models / use cases --}}
            <section id="modelos" class="mx-auto mt-20 max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-white/8 to-white/3 p-8 shadow-2xl">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Feito para o seu fluxo</h2>
                            <p class="mt-2 max-w-2xl text-sm text-slate-300">
                                Use como base para telas de Clientes, Produtos, Pedidos e Produção.
                                O visual mantém consistência em todo o sistema.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <span class="rounded-full bg-white/5 px-4 py-2 text-xs font-semibold text-slate-200 ring-1 ring-white/10">Clientes</span>
                            <span class="rounded-full bg-white/5 px-4 py-2 text-xs font-semibold text-slate-200 ring-1 ring-white/10">Produtos</span>
                            <span class="rounded-full bg-white/5 px-4 py-2 text-xs font-semibold text-slate-200 ring-1 ring-white/10">Pedidos</span>
                            <span class="rounded-full bg-white/5 px-4 py-2 text-xs font-semibold text-slate-200 ring-1 ring-white/10">Produção</span>
                            <span class="rounded-full bg-white/5 px-4 py-2 text-xs font-semibold text-slate-200 ring-1 ring-white/10">Relatórios</span>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 lg:grid-cols-3">
                        <div class="rounded-3xl bg-slate-950/40 p-6 ring-1 ring-white/10">
                            <div class="text-sm font-semibold text-white">Tela de listagem</div>
                            <p class="mt-2 text-sm text-slate-300">Tabela limpa, filtros, badge de status e ações rápidas.</p>
                            <div class="mt-4 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <div class="flex items-center justify-between text-xs text-slate-300">
                                    <span>Pedidos abertos</span><span class="text-white/90 font-semibold">24</span>
                                </div>
                                <div class="mt-3 flex items-center justify-between text-xs text-slate-300">
                                    <span>Em produção</span><span class="text-white/90 font-semibold">11</span>
                                </div>
                                <div class="mt-3 flex items-center justify-between text-xs text-slate-300">
                                    <span>Entregues</span><span class="text-white/90 font-semibold">56</span>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-slate-950/40 p-6 ring-1 ring-white/10">
                            <div class="text-sm font-semibold text-white">Tela de detalhe</div>
                            <p class="mt-2 text-sm text-slate-300">Resumo com cards e timeline de etapas.</p>
                            <div class="mt-4 space-y-3">
                                <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-slate-300">Status</span>
                                        <span class="rounded-full bg-indigo-500/15 px-3 py-1 text-xs font-semibold text-indigo-200 ring-1 ring-indigo-500/25">Em produção</span>
                                    </div>
                                </div>
                                <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                    <div class="text-xs text-slate-300">Próxima etapa</div>
                                    <div class="mt-1 text-sm font-semibold text-white">Acabamento</div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-slate-950/40 p-6 ring-1 ring-white/10">
                            <div class="text-sm font-semibold text-white">Formulários</div>
                            <p class="mt-2 text-sm text-slate-300">Inputs com foco suave e validações claras.</p>
                            <div class="mt-4 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <label class="text-xs text-slate-300">Nome</label>
                                <div class="mt-2 h-10 rounded-xl bg-slate-950/40 ring-1 ring-white/10"></div>
                                <label class="mt-4 block text-xs text-slate-300">Telefone</label>
                                <div class="mt-2 h-10 rounded-xl bg-slate-950/40 ring-1 ring-white/10"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Testimonials --}}
            <section id="depoimentos" class="mx-auto mt-20 max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between gap-6">
                    <div>
                        <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Depoimentos</h2>
                        <p class="mt-2 max-w-2xl text-sm text-slate-300">Texto demonstrativo (substitua por dados reais depois).</p>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 lg:grid-cols-3">
                    @php
                    $quotes = [
                    ['“A produção ficou muito mais previsível. Visual limpo e rápido.”', 'Responsável pela produção'],
                    ['“Agora consigo ver pendências do dia em segundos.”', 'Administrativo'],
                    ['“O sistema passou mais confiança para a equipe e para os clientes.”', 'Gestão'],
                    ];
                    @endphp

                    @foreach($quotes as [$q, $who])
                    <figure class="rounded-3xl border border-white/10 bg-white/5 p-6">
                        <blockquote class="text-sm leading-relaxed text-slate-200/90">{{ $q }}</blockquote>
                        <figcaption class="mt-4 text-xs text-slate-400">{{ $who }}</figcaption>
                    </figure>
                    @endforeach
                </div>

                {{-- CTA --}}
                <section id="contato" class="mt-12">
                    <div class="rounded-3xl border border-white/10 bg-gradient-to-r from-indigo-500/15 to-fuchsia-500/15 p-8">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-white">Pronto para colocar isso no ar?</h3>
                                <p class="mt-2 max-w-2xl text-sm text-slate-300">
                                    Se quiser, eu adapto este layout para um <code class="rounded bg-black/30 px-1.5 py-0.5">layouts/app.blade.php</code> e deixo
                                    componentes reutilizáveis (cards, botões, badges, tabelas).
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-950 hover:bg-slate-100">
                                    Abrir painel
                                </a>
                                <a href="#"
                                    class="inline-flex items-center justify-center rounded-xl bg-white/10 px-5 py-3 text-sm font-semibold text-white ring-1 ring-white/15 hover:bg-white/15">
                                    Falar com suporte
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </main>

        <footer class="border-t border-white/10">
            <div class="mx-auto max-w-7xl px-4 py-10 text-center text-xs text-slate-400 sm:px-6 lg:px-8">
                © {{ date('Y') }} {{ config('app.name', 'Confecção') }} • Construído com Laravel
            </div>
        </footer>
    </div>
</body>

</html>