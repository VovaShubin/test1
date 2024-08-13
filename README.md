POST запрос на получение Beare токена доступа http://test1/api/user/auth парметры {"username":"name", "password":"12345678"};

далее все запросы с Beare токеном обратить внимание в отличаи от метода auth далее users:

GET /api/users: получение постранично списка всех пользователей; 

GET /api/users/123: получение информации по конкретному пользователю с id равным 123;

POST /api/users: создание нового пользователя параметры {"username":"name", "email":"email", "password":"12345678"};

PUT /api/users/123: изменение информации по пользователю с id равным 123 парметры {	"update field": "new value" }

DELETE /api/users/123: удаление пользователя с id равным 123;