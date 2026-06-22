<?php
session_start();
require_once 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    if ($email && $senha) {
        try {
            // Buscando o usuário no banco de dados do TiDB
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificação simples de senha (depois implementamos hash seguro)
            if ($usuario && $senha === $usuario['senha']) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_role'] = $usuario['role'];
                $_SESSION['loja_id'] = $usuario['loja_id'];

                // Login com sucesso! Redireciona ou mostra mensagem
                $sucesso = true;
            } else {
                $erro = 'E-mail ou senha incorretos.';
            }
        } catch (PDOException $e) {
            $erro = 'Erro ao processar login: ' . $e->getMessage();
        }
    } else {
        $erro = 'Por favor, preencha todos os campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mega Supermercados - Monitoramento</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body { background-color: #0f172a; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-slate-200 px-4">

    <div class="w-full max-w-md bg-slate-900 border border-slate-800 p-8 rounded-2xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-blue-500 tracking-tight">MEGA</h1>
            <p class="text-xs uppercase tracking-widest text-slate-400 mt-1">Controle de Temperatura</p>
        </div>

        <?php if (isset($sucesso)): ?>
            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-4 rounded-xl text-center mb-6">
                <p class="font-bold text-lg">🔑 Login realizado com sucesso!</p>
                <p class="text-sm mt-1">Conectado como <?php echo htmlspecialchars($usuario['nome']); ?>.</p>
                <p class="text-xs text-slate-400 mt-3">A estrutura do banco de dados e a autenticação em nuvem estão funcionando perfeitamente.</p>
            </div>
        <?php else: ?>

            <?php if ($erro): ?>
                <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 p-3 rounded-xl text-sm mb-4 text-center">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">E-mail Corporativo</label>
                    <input type="email" name="email" required placeholder="nome@empresa.com" 
                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Senha de Acesso</label>
                    <input type="password" name="senha" required placeholder="••••••••" 
                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 rounded-xl shadow-lg shadow-blue-600/20 transition-all cursor-pointer mt-2 text-center block">
                    Entrar no Painel
                </button>
            </form>
        <?php endif; ?>

        <div class="text-center mt-8 border-t border-slate-800/60 pt-4">
            <p class="text-xs text-slate-500">&copy; 2026 Mega Supermercados S.A.</p>
        </div>
    </div>

</body>
</html>
