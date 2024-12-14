const windowsWithTimer = document.querySelectorAll('.timer');

const timer = (timerElement, deadline) => {
    const deadlineTime = new Date(deadline).getTime();

    const intervalId = setInterval(() => {
        const now = new Date().getTime();
        const distance = deadlineTime - now;

        // Если время истекло, останавливаем таймер и обновляем текст
        if (distance < 0) {
            clearInterval(intervalId);
            timerElement.innerText = "Время истекло!";
            timerElement.className += ' timer--finishing';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Форматируем отображение (добавляем ведущие нули при необходимости)
        const formattedDays = days.toString().padStart(2, '0');
        const formattedHours = hours.toString().padStart(2, '0');
        const formattedMinutes = minutes.toString().padStart(2, '0');
        const formattedSeconds = seconds.toString().padStart(2, '0');

        // Обновляем текст внутри элемента таймера
        timerElement.innerText = `${formattedDays}d ${formattedHours}h ${formattedMinutes}m ${formattedSeconds}s`
    }, 10)
}


windowsWithTimer.forEach(timerElement => {
    const deadline = timerElement.getAttribute('data-deadline'); // Предполагаем, что дата хранится в
    if (deadline) {
        timer(timerElement, deadline);
    } else {
        console.error('Не указана дата окончания для таймера:', timerElement);
    }
});