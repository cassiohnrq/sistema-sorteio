# sistema-sorteio
Sistema web para gestão de cupons e sorteios, com cadastro e edição de usuários, importação e exportação de dados, conferência de cupons, realização de sorteios automáticos e controle de acesso. Interface simples, segura e com funções administrativas completas.

# 🎯 Sistema de Sorteios e Cupons

## 📋 Descrição do Projeto
O sistema tem como objetivo gerenciar usuários, cupons e sorteios de forma simples e eficiente.  
As telas e funcionalidades listadas abaixo fazem parte dos **Requisitos Funcionais (RF)** do sistema.

---

## ⚙️ Funcionalidades

### 4.1.1 Tela de Login (RF001)
A página contém dois campos onde o usuário deve inserir **e-mail** e **senha**, além de um **botão de acesso**.  
Os dados são enviados ao banco de dados, e o sistema retorna o resultado de autenticação.  
Há uma **pequena logo centralizada na parte superior** da tela.

---

### 4.1.2 Tela de Usuários Cadastrados (RF002)
Lista todos os usuários do sistema, exibindo:


A página também conta com um **menu**, e **botões de editar e excluir** para cada linha.

---

### 4.1.3 Tela de Edição de Usuários (RF003)
Apresenta os campos do usuário selecionado já preenchidos:


Inclui um **botão de atualizar** as informações.

---

### 4.1.4 Tela de Cadastro de Novos Usuários (RF004)
Permite cadastrar um novo usuário preenchendo:


Possui um **botão de cadastrar**.

---

### 4.1.5 Tela de Cupons Cadastrados (RF005)
Exibe os cupons cadastrados com as colunas:

Contém **botões de editar e excluir**, campo de **pesquisa por matrícula ou nome**, e **paginação com até 1000 linhas por página**.

---

### 4.1.6 Tela de Exibição de Pesquisa (RF006)
Mostra o resultado de uma pesquisa de cupons, com:


Inclui **botões de edição e exclusão**, **campo de pesquisa**, **paginação com 100 linhas por página**, e opção de **impressão dos resultados**.

---

### 4.1.7 Tela de Edição de Cupons (RF007)
Permite editar um cupom existente.  

Possui **botão de atualizar**.

---

### 4.1.8 Tela de Cadastro de Novo Cupom (RF008)
Permite cadastrar novos cupons com os campos:

Inclui **botão de cadastrar**.

---

### 4.1.9 Tela de Novo Sorteio
Permite configurar um novo sorteio, inserindo:
- Título  
- Descrição  
- Logo  
- Plano de fundo (para celular e computador)

As configurações são aplicadas nas páginas de:
- Consulta de cupons(index)  
- Sorteio

---

### 4.1.10 Tela de Limpeza de Dados
Permite **limpar todos os dados da tabela** de cupons.  
O usuário deve **marcar um checkbox** para liberar o botão de exclusão total.

---

### 4.1.11 Tela de Conferir Cupons
Permite ao usuário **inserir um CPF ou CNPJ** e exibir:
- Quantos cupons a pessoa possui  
- Soma total de cupons

---

### 4.1.12 Tela de Sorteio
Seleciona **aleatoriamente um usuário** do banco de dados como **ganhador do sorteio**.

---

### 4.1.13 Tela de Importação de Cupons (RF009)
Permite importar cupons através de um **arquivo.csv ou similar**, com os dados:

---

### 4.1.14 Tela de Exportação de Cupons (RF010)
Exporta todos os cupons cadastrados no sistema em formato **Excel (.xls)**, contendo:

---

### 4.1.15 Tela de Confirmação de Importação (RF011)
Exibe uma mensagem informando:
- Se a importação foi realizada com sucesso  
- Quantidade de linhas importadas  

Ou, em caso de falha, notifica que não foi possível realizar a importação.

---

### 4.1.16 Função Excluir (RF012)
Permite excluir uma linha específica (usuário ou cupom) ao clicar no **ícone de exclusão**.

---

### 4.1.17 Função Imprimir (RF013)
Abre uma nova janela com os dados simplificados e formatados para **impressão**, exibindo todas as colunas do sistema.

---

### 4.1.18 Paginação (RF014)
Permite navegar pelos registros:
- **1000 registros por página** nas telas de cupons cadastrados  
- **100 registros por página** nas telas de pesquisa  

---

### 4.1.19 Sair (RF015)
Função de **logout** do sistema, encerrando a sessão do usuário.  
Caso o usuário esqueça de sair manualmente, o sistema realizará o logout automaticamente após um período de inatividade.

---

## 🧱 Tecnologias Utilizadas
- **Frontend:** HTML5, CSS3, JavaScript  
- **Backend:** PHP  
- **Gerenciador de Dependências:** Composer (vendor)  
- **Banco de Dados:** MySQL  
- **Exportação:** XLS (Excel)  
- **Importação:** XML  

---

## 👥 Perfis de Usuário
- **Administrador:** Acesso completo a todas as telas e funções.  
- **Usuário Padrão:** Acesso restrito a cupons e sorteios.  



