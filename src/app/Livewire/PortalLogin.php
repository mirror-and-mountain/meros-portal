<?php

namespace MM\Meros\Portal\App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;

use MM\Meros\Portal\Accessor;
use MM\Meros\Facades\Components\Forms;

use MM\Meros\Contracts\Features\Components\Form;
use MM\Meros\Contracts\Features\Components\Field;

class PortalLogin extends Component {
    private string $formHtml = '';

    public function mount() {
        $loginForm = Forms::checkout(Accessor::get())
        ->make(function (Form $form) {
            $form->id('meros-portal-login');
            $form->name('meros_portal_login');
            $form->useDefaultStyles();

            $form->field('text', [
                'id'       => 'meros-portal-login-username',
                'name'     => 'username',
                'label'    => 'Username',
                'required' => true
            ]);

            $form->field('password', [
                'id'       => 'meros-portal-login-password',
                'name'     => 'password',
                'label'    => 'Password',
                'required' => true
            ]);

            $form->onSubmit('merosPortalLogin');
        });

        $this->formHtml = $loginForm->html();
    }

    public function render() {
        return view('meros_portal::portal-login', [
            'formHtml' => $this->formHtml
        ])->layout('meros_portal::portal-layout');
    }

    #[Renderless]
    public function login(string $username, string $password): bool {
        if ($username !== '' && $password !== '') {
            $result = Auth::attempt([
                'email' => $username,
                'password' => $password
            ]);

            if ($result === true) {
                $this->redirectRoute('portal.dashboard');
            }

            return $result;
        }

        return false;
    }
}