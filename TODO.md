# TODOs

- [x] Crear + Modelo

- [x] Formularios - questionnaries:
  - [x] title
  - [x] description

- [x] Pregunta: (Descripción y comportamiento para la pregunta) - question
  - [x] Título
  - [x] categoria (fk)
  - [x] Descripción (optioal)
  - [x] Imágen (optional)
  - [x] Obligatorio:
    - [x] boolean
  - [x] Type: (enum)
    - [x] Short text
      - [x] Input
    - [x] Long text
      - [x] Text area
    - [x] Opción multiple, con única respuesta
      - [x] Raddio button
      - [x] Permité agregar la opción `otro...` que es un input
    - [x] Cacilla de verificación (Check box)
      - [x] Check box
      - [x] Permité agregar la opción `otro...` que es un input
    - [x] Lista desplegable
      - [x] Select

Nota: crear seeder para guardar categoria de tipo (emocional y matematico)}

- [x] Categorias:
  - [x] text (unico)

- [x] Opción: (Opción para la pregunta)
  - [x] texto
  - [x] puntaje (optional)
  - [x] Pregunta fk

DEFINIR: si 1 pregunta puede estár en multiples formularios

ORDEN:

- questionnarie
- question cat
- question
- question opt

## 11

- [ ] Add seeder with emotional questions by default