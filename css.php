<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@600;700;800&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg:       #0e0e12;
        --surface:  #16161c;
        --border:   rgba(255,255,255,0.08);
        --text:     #e8e8f0;
        --muted:    #6b6b80;
        --add:      #00e676;
        --sub:      #ff9100;
        --mul:      #40c4ff;
        --div:      #ff4d6d;
    }

    html { font-size: 16px; }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: 'DM Mono', monospace;
        min-height: 100vh;
        padding: 0 0 60px;
    }

    /* ── Shared page header ── */
    .page-header {
        padding: 28px 40px 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 36px;
    }
    .page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text);
    }
    .back-btn {
        text-decoration: none;
        color: var(--muted);
        font-size: 13px;
        border: 1px solid var(--border);
        padding: 6px 14px;
        border-radius: 6px;
        transition: color .2s, border-color .2s;
        white-space: nowrap;
    }
    .back-btn:hover { color: var(--text); border-color: rgba(255,255,255,0.25); }

    /* ── Index layout ── */
    .index-wrap {
        max-width: 960px;
        margin: 0 auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }
    @media(max-width:640px) { .index-wrap { grid-template-columns: 1fr; } }

    /* ── Single page layout ── */
    .single-page .page-header { margin-bottom: 32px; }
    .single-wrap {
        max-width: 480px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* ── Card ── */
    .calc-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 28px 26px 24px;
        position: relative;
        overflow: hidden;
        transition: transform .2s;
    }
    .calc-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
    }
    .calc-card.add::before    { background: var(--add); }
    .calc-card.subtract::before { background: var(--sub); }
    .calc-card.multiply::before { background: var(--mul); }
    .calc-card.divide::before   { background: var(--div); }

    .card-top {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
    }
    .card-top h2 {
        font-family: 'Syne', sans-serif;
        font-size: 17px;
        font-weight: 700;
        color: var(--text);
    }
    .card-top .formula {
        font-size: 11px;
        color: var(--muted);
        margin-top: 3px;
        letter-spacing: .5px;
    }

    /* ── Op icon ── */
    .op-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; font-weight: 700;
        flex-shrink: 0;
        font-family: 'Syne', sans-serif;
    }
    .op-icon.add      { background: rgba(0,230,118,0.12);  color: var(--add); }
    .op-icon.subtract { background: rgba(255,145,0,0.12);  color: var(--sub); }
    .op-icon.multiply { background: rgba(64,196,255,0.12); color: var(--mul); }
    .op-icon.divide   { background: rgba(255,77,109,0.12); color: var(--div); }

    /* ── Form ── */
    label {
        display: block;
        font-size: 10px;
        font-weight: 500;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }
    input[type="number"] {
        width: 100%;
        padding: 11px 14px;
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 15px;
        font-family: 'DM Mono', monospace;
        color: var(--text);
        outline: none;
        margin-bottom: 14px;
        transition: border-color .2s, background .2s;
        -moz-appearance: textfield;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button { -webkit-appearance: none; }
    input[type="number"]::placeholder { color: #333340; }

    .calc-card.add      input[type="number"]:focus { border-color: var(--add); background: rgba(0,230,118,0.04); }
    .calc-card.subtract input[type="number"]:focus { border-color: var(--sub); background: rgba(255,145,0,0.04); }
    .calc-card.multiply input[type="number"]:focus { border-color: var(--mul); background: rgba(64,196,255,0.04); }
    .calc-card.divide   input[type="number"]:focus { border-color: var(--div); background: rgba(255,77,109,0.04); }

    /* ── Operator divider ── */
    .op-divider {
        display: flex; align-items: center; justify-content: center;
        margin: -4px 0 14px;
    }
    .op-pill {
        font-family: 'Syne', sans-serif;
        font-size: 16px; font-weight: 700;
        width: 34px; height: 34px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        border: 1px solid;
    }
    .op-pill.add      { color: var(--add); border-color: rgba(0,230,118,0.4);  background: rgba(0,230,118,0.07); }
    .op-pill.subtract { color: var(--sub); border-color: rgba(255,145,0,0.4);  background: rgba(255,145,0,0.07); }
    .op-pill.multiply { color: var(--mul); border-color: rgba(64,196,255,0.4); background: rgba(64,196,255,0.07); }
    .op-pill.divide   { color: var(--div); border-color: rgba(255,77,109,0.4); background: rgba(255,77,109,0.07); }

    /* ── Button ── */
    .btn {
        width: 100%; padding: 12px;
        border: none; border-radius: 10px;
        font-size: 14px; font-weight: 500;
        font-family: 'DM Mono', monospace;
        letter-spacing: .5px;
        cursor: pointer; color: #0e0e12;
        transition: opacity .2s, transform .15s;
        margin-top: 2px;
    }
    .btn:hover { opacity: .88; transform: translateY(-2px); }
    .btn.add      { background: var(--add); }
    .btn.subtract { background: var(--sub); }
    .btn.multiply { background: var(--mul); }
    .btn.divide   { background: var(--div); }

    /* ── Messages ── */
    .msg {
        margin-top: 16px;
        border-radius: 10px;
        padding: 14px 16px;
        text-align: center;
    }
    .msg.error {
        background: rgba(255,77,109,0.1);
        border: 1px solid rgba(255,77,109,0.3);
        color: #ff8fa3;
        font-size: 13px;
    }
    .msg.result { display: flex; flex-direction: column; gap: 4px; }
    .msg.result .expr { font-size: 12px; color: var(--muted); }
    .msg.result .answer { font-size: 30px; font-weight: 500; font-family: 'Syne', sans-serif; }

    .msg.result.add      { background: rgba(0,230,118,0.07);  border: 1px solid rgba(0,230,118,0.25);  }
    .msg.result.add      .answer { color: var(--add); }
    .msg.result.subtract { background: rgba(255,145,0,0.07);  border: 1px solid rgba(255,145,0,0.25);  }
    .msg.result.subtract .answer { color: var(--sub); }
    .msg.result.multiply { background: rgba(64,196,255,0.07); border: 1px solid rgba(64,196,255,0.25); }
    .msg.result.multiply .answer { color: var(--mul); }
    .msg.result.divide   { background: rgba(255,77,109,0.07); border: 1px solid rgba(255,77,109,0.25); }
    .msg.result.divide   .answer { color: var(--div); }

    /* ── Index title ── */
    .index-title {
        text-align: center;
        padding: 48px 24px 36px;
    }
    .index-title .logo { font-size: 48px; line-height: 1; }
    .index-title h1 {
        font-family: 'Syne', sans-serif;
        font-size: 32px; font-weight: 800;
        margin-top: 12px; color: var(--text);
        letter-spacing: -0.5px;
    }
    .index-title p { color: var(--muted); font-size: 13px; margin-top: 6px; }

    /* ── Footer ── */
    .footer { text-align: center; color: #2a2a38; font-size: 11px; margin-top: 40px; letter-spacing: .5px; }
</style>