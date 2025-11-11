// ==================== menu del perfil  ====================

document.addEventListener('DOMContentLoaded', () => {
// === Panel de usuario ===
const userIcon  = document.getElementById('usuarioBoton');
const userPanel = document.getElementById('panelUsuario');

if (userIcon && userPanel) {
    // abrir/cerrar con click
    userIcon.addEventListener('click', (e) => {
    e.stopPropagation();
    userPanel.classList.toggle('is-open');
    userPanel.setAttribute('aria-hidden', userPanel.classList.contains('is-open') ? 'false' : 'true');
    });

    // cerrar si hago click afuera
    window.addEventListener('click', (e) => {
    if (!userPanel.contains(e.target) && !userIcon.contains(e.target)) {
        userPanel.classList.remove('is-open');
        userPanel.setAttribute('aria-hidden', 'true');
    }
    });

    // cerrar con Escape
    window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        userPanel.classList.remove('is-open');
        userPanel.setAttribute('aria-hidden', 'true');
    }
    });
}

    const KEY = 'conectaUTU.profile';
    const defaults = () => ({

    name: LANG.label_fullname2,
    
    username: LANG.placeholder_user,
    email: LANG.placeholder_email,
    bio: LANG.biography_description,
    
    avatar: "https://picsum.photos/seed/utu/600/600",
});

function loadProfile() {
    try {
    const raw = localStorage.getItem(KEY);
    return raw ? JSON.parse(raw) : defaults();
    } catch {
    return defaults();
    }
}

function saveProfile(p) {
    try {
    localStorage.setItem(KEY, JSON.stringify(p));
    return true;
    } catch {
    return false;
    }
}

const $ = (s, p = document) => p.querySelector(s);
const $$ = (s, p = document) => Array.from(p.querySelectorAll(s));
const esc = s => String(s).replace(/[&<>"']/g, m => ({
    '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'
}[m]));

// ================= RENDER VISTA (perfil.html) =================
function initProfileView() {
    const nameEl   = $("#viewName");
    const userEl   = $("#viewUser");
    const emailEl  = $("#viewEmail");
    const bioEl    = $("#viewBio");
    const avatarEl = $("#viewAvatar");
    const tagsEl   = $("#viewTags");
    if (!nameEl || !userEl || !emailEl || !bioEl || !avatarEl || !tagsEl) return;

    const profile = loadProfile();
    nameEl.textContent    = profile.name || LANG.label_fullname2; // Usamos la clave del nombre por defecto
    userEl.textContent    = profile.username ? `@${profile.username}` : `@${LANG.placeholder_user}`; // Usamos la clave de usuario
    emailEl.textContent   = profile.email || LANG.placeholder_email; // Usamos la clave de email
    bioEl.textContent     = profile.bio || LANG.biography_description; // Usamos la clave de biografía
    avatarEl.src        = profile.avatar || "https://picsum.photos/seed/utu/600/600";
    tagsEl.innerHTML    = (profile.tags || []).map(t => `<span class="chip">${esc(t)}</span>`).join("");
}

// ================= EDITOR (profile-editor.html) =================
function initProfileEditor() {
    const form = $("#profileForm");
    if (!form) return;

    const state = loadProfile();

    const nameI = $("#name"), userI = $("#username"), emailI = $("#email"), bioI = $("#bio"), avatarI = $("#avatar");
    const tagsBox = $("#tagsBox"), tagInput = $("#tagInput");

    const prevName = $("#previewName"), prevUser = $("#previewUser"), prevEmail = $("#previewEmail");
    const prevBio = $("#previewBio"), prevAvatar = $("#previewAvatar"), prevChips = $("#previewChips");

    function render() {
    if (prevName)   prevName.textContent    = state.name || LANG.label_fullname2; // Clave de nombre
        if (prevUser)   prevUser.textContent    = state.username ? `@${state.username}` : `@${LANG.placeholder_user}`; // Clave de usuario
        if (prevEmail)  prevEmail.textContent   = state.email || LANG.placeholder_email; // Clave de email
        if (prevBio)    prevBio.textContent     = state.bio || LANG.biography_description; // Clave de biografía
        if (prevAvatar) prevAvatar.src          = state.avatar || "";
        if (prevChips)  prevChips.innerHTML     = (state.tags || []).map(t => `<span class="chip">${esc(t)}</span>`).join("");
    if (nameI)  nameI.value  = state.name || "";
    if (userI)  userI.value  = state.username || "";
    if (emailI) emailI.value = state.email || "";
    if (bioI)   bioI.value   = state.bio || "";
    drawTagChipsEditor();
    }

    function drawTagChipsEditor() {
    if (!tagsBox) return;
    $$(".tag", tagsBox).forEach(n => n.remove());
    (state.tags || []).forEach((t, idx) => {
        const el = document.createElement("span");
        el.className = "tag";
// Agregamos la comilla de cierre al final del aria-label y cerramos la etiqueta con '>'
el.innerHTML = `${esc(t)} <button title="${LANG.delete_tag_title}" aria-label="${LANG.delete_tag_aria}">×</button>`;        el.querySelector("button").onclick = () => { state.tags.splice(idx, 1); render(); };
        tagsBox.insertBefore(el, tagInput);
    });
    }

    nameI  && nameI.addEventListener('input', e => { state.name = e.target.value; render(); });
    userI  && userI.addEventListener('input', e => { state.username = e.target.value.replace(/^@/, ''); render(); });
    emailI && emailI.addEventListener('input', e => { state.email = e.target.value; render(); });
    bioI   && bioI.addEventListener('input', e => { state.bio = e.target.value; render(); });

    avatarI && avatarI.addEventListener('change', e => {
        const f = e.target.files?.[0];
        if (!f) return;
        const reader = new FileReader();
        reader.onload = () => { state.avatar = reader.result; render(); };
        reader.readAsDataURL(f);
    });

    tagInput && tagInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        const v = tagInput.value.trim();
        if (v && !state.tags.includes(v)) state.tags.push(v);
        tagInput.value = '';
        render();
    }
    });

    form.addEventListener('submit', e => {
    e.preventDefault();
    saveProfile(state);
    const btn = e.submitter;
    if (btn) {
        const t = btn.textContent;
    btn.textContent = LANG.save_succes; 
    btn.disabled = true;
        setTimeout(() => { btn.textContent = t; btn.disabled = false; }, 1200);
    }
    });

    const btnReset = $("#btnReset");
    btnReset && btnReset.addEventListener('click', () => {
    Object.assign(state, defaults());
    render();
    });

    render();
}

// ================= Header opcional: mostrar nombre/mini avatar =================
function initHeaderExtras() {
    const headerName = document.getElementById('headerUserName');
    if (headerName) {
    const p = loadProfile();
    headerName.textContent = p.name || '';
    }
    
}

// ================= Offset dinámico (navbar fix) gracias gemini =================
function applyOffset(){
    const header = document.querySelector('.header');
    const nav    = document.querySelector('.paneles');
    if(!header || !nav) return;

    // altura total de header + nav + holgura
    const offset = header.getBoundingClientRect().height +
                nav.getBoundingClientRect().height +
                24; // holgura razonable

    // usar padding-top (no margin-top) en ambas vistas
    const perfilMain = document.querySelector('.perfilWrap');
    if (perfilMain) {
    perfilMain.style.paddingTop = offset + 'px';
    perfilMain.style.setProperty('--perfil-offset', offset + 'px');
    perfilMain.style.setProperty('--sticky-offset', offset + 'px');
    }

    const editorMain = document.querySelector('.editorWrap'); // NUEVO: edperfil.html
    if (editorMain) {
    editorMain.style.paddingTop = offset + 'px';
    editorMain.style.setProperty('--perfil-offset', offset + 'px');
    editorMain.style.setProperty('--sticky-offset', offset + 'px');
    }
}

// ---- Inicialización ----
initProfileView();
initProfileEditor();
initHeaderExtras();
applyOffset();

window.addEventListener('resize', applyOffset);
window.addEventListener('load', applyOffset);
if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(applyOffset).catch(()=>{});
}

// ==== PUBLICACIONES DEL PERFIL ====
(function(){
    const postsContainer = document.getElementById('postsContainer');
    if (!postsContainer) return; // si no estamos en el perfil

    // Ejemplo de posts — después los podés guardar en localStorage o en base de datos
    const posts = [
        {
            titulo: "CONSEGUI LABUROOO ESO BRAD ",
            contenido: " ",
            fecha: "13/10/2025"
        },
        {
            titulo: "TENES 50 PESOS PARA EL HADES 2 ????? ",
            contenido: " nececito chamba nececito mucha chamba  ",
            fecha: "11/10/2025"
        }
        ,{
            titulo: "DIABLAZO",
            contenido: "papeado jajalol",
            fecha: "11/10/2025"
        }
    ];

    // Render de los posts
    posts.forEach(p => {
        const card = document.createElement('div');
        card.className = 'postCard';
        card.innerHTML = `
            <h3>${p.titulo}</h3>
            <p>${p.contenido}</p>
            <div class="postDate">${p.fecha}</div>
        `;
        postsContainer.appendChild(card);
    });
})();

});
