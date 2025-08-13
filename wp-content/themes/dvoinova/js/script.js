function sendEmailNotification() {
    const emailData = {
        to: 'xander.belov23@yandex.ru', // Замените на ваш email
        subject: 'Элемент был нажат',
        message: 'Элемент с id "congratulation" был нажат.'
    };

    fetch('../php/send-email.php', { // Указываем путь к PHP-скрипту
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(emailData),
    })
    .then(response => response.text())
    .then(data => {
        console.log('Ответ от сервера:', data);
    })
    .catch((error) => {
        console.error('Ошибка при отправке уведомления:', error);
    });
}