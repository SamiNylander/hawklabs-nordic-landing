let currentLanguage = "sv";
async function loadLanguage(lang) {
    currentLanguage = lang;
    localStorage.setItem(
        "jobhawk_lang",
        lang
    );
    const response = await fetch(
        `/lang/${lang}.json`
    );
    const translations =
        await response.json();

    document
        .querySelectorAll("[data-i18n]")
        .forEach(element => {
            const key =
                element.dataset.i18n;
            if (translations[key]) {
                element.textContent =
                    translations[key];
            }

        });
}
