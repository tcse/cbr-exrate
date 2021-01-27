# cbr-exrate
Курсы валют Центробанка России для DataLife Engine

![](https://sun9-54.userapi.com/impf/eiQJ1YXbgH_64clTq-23OPd0A6G0VaN8ILB3Tg/ifAHXASH2-c.jpg?size=827x437&quality=96&proxy=1&sign=bfbd54e730ec0e88f4ee9bff9f6922da&type=album)

## Установка 
Через систему плагинов DLE 13 и выше.

В шаблон сайта main.tpl в удобное место добавить тег {exrate} 

### Редактировать шаблон валют
Открыть файл шаблона {THEME}/assets/cbr-exrate/exrate.tpl и внести необходимые изменнеия. 

Поддерживаемые теги:

USD ЦБ: <b>{dollar}</b>

EUR ЦБ: <b>{euro}</b>

BYN ЦБ: <b>{byn}</b>

KZT ЦБ: <b>{kzt}</b>

UAH ЦБ: <b>{uah}</b>

Дополнительные теги (отображаются, только если сайт www.cbr.ru выдал эти значения)

[tommorow] и [/tommorow] - отображает предполагаемые курсы валют на завтра

<b>{dollar-tommrow}</b> - вывод курса доллара США на завтра

<b>{euro-tomorrow}</b> - вывод курса Евро на завтра

<b>{byn-tomorrow}</b> - вывод курса Беларуского рубля на завтра

<b>{kzt-tomorrow}</b> - вывод курса Казахстанского тенге на завтра

<b>{uah-tomorrow}</b> - вывод курса Украинской гривны на завтра
