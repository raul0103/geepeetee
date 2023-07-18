/**
 * Отслеживает ввод пароля при регистрации и уведомляет об ошибках
 */
const error_message_field = document.getElementById("password-error-message");
const options = {
    min_password_length: 8,
};

document
    .querySelectorAll('[name="password"],[name="password_confirmation"]')
    .forEach((input) => {
        input.addEventListener("input", () => {
            if (input.value.length < options.min_password_length) {
                error_message_field.textContent = `Длина пароля минимум ${
                    options.min_password_length
                } символов. Осталось (${
                    options.min_password_length - input.value.length
                })`;
            } else {
                error_message_field.textContent = "";
            }
        });
    });
