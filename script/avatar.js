import { createAvatar } from 'https://cdn.skypack.dev/@dicebear/avatars';
import * as style from 'https://cdn.skypack.dev/@dicebear/micah';

let svg = createAvatar(style,{
    flip: true,
    backgroundColor: "#6A54C0",
    scale: 90,
    translateY: 5
});

document.getElementById('img-url').value = `${btoa(svg)}`

