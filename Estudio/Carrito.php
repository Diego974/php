/* CASO 1: CARRITO DE LA COMPRA (Dato sensible y temporal) /
// ¿COOKIE o SESSION?
Usamos: SESSION // [Hueco 1]

// Primera línea obligatoria:
session_start(); // [Hueco 2]


/ CASO 2: RECORDAR USUARIO (Para que dure días en su PC) /
// ¿COOKIE o SESSION?
Usamos: COOKIE // [Hueco 3]

// Fórmula matemática para 30 días (en segundos):
setcookie("usuario", "Juan", time() + ( 30 * 24 * 60 * 60 ) ); // [Hueco 4]