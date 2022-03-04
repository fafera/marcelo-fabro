@extends('front.layout.app')
@section('content')
<section id="create-page" class="request-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="feature-description text-white">
                    <h2>Chegou a hora de criar sua página!</h2>
                    <hr>
                    <div class="feature-left">
                        <div class="feature-content">
                            <p class="feature">Esta página foi criada exclusivamente para
                                o seu casamento. Só preciso de mais alguns
                                dados para liberar seu acesso ao sistema
                                contendo todas as informações de nosso
                                contrato, além do painel para definir o repertório.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-xl-1 col-xl-6 offset-lg-1 col-lg-10 offset-md-1 col-md-10 col-sm-12 col-12 mt30">
                <livewire:front.client-page-form :page="$page"/>
            </div>
        </div>
    </div>
</section>
@endsection

