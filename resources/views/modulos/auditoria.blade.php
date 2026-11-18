<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Auditoría avanzada" subtitle="Modelo de control interno, matriz de riesgos y manual metodológico" icon="clipboard" />
    </x-slot>

    @push('head')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css">
    @endpush
    <style>
        /* ── ESTILOS EXCLUSIVOS SECCIÓN MANUAL ── */
        .man-hero {
            background: linear-gradient(135deg, #0f172a 0%, #0b1220 100%);
            border-radius: var(--radius);
            padding: 22px 26px;
            margin-bottom: 18px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid #06b6d4;
        }

        .man-hero::before {
            content: '📋';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 80px;
            opacity: .07;
        }

        .man-eyebrow {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: .75;
            margin-bottom: 6px;
        }

        .man-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .man-sub {
            font-size: 12px;
            opacity: .85;
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .man-badge {
            display: inline-block;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .35);
            padding: 3px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            margin-right: 6px;
            margin-bottom: 4px;
            letter-spacing: .5px;
        }

        /* Chapter nav buttons */
        .man-chapters {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 18px;
        }

        .man-ch-btn {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: var(--radius);
            padding: 14px 16px;
            cursor: pointer;
            text-align: left;
            transition: all .18s;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-left: 4px solid #0f172a;
        }

        .man-ch-btn:hover {
            background: #FCEAEA;
            border-color: #0f172a;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(15, 23, 42, .12);
        }

        .man-ch-btn.active {
            background: #FCEAEA;
            border-color: #0f172a;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .15);
        }

        .man-ch-icon {
            font-size: 22px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .man-ch-num {
            font-size: 9px;
            font-weight: 800;
            color: #06b6d4;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .man-ch-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.3;
        }

        .man-ch-desc {
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px;
            line-height: 1.4;
        }

        /* Chapter content */
        .man-chapter {
            display: none;
        }

        .man-chapter.active {
            display: block;
        }

        /* Section separators inside manual */
        .man-sep {
            display: flex;
            align-items: center;
            gap: 0;
            margin: 16px 0 12px;
            border-radius: 8px;
            overflow: hidden;
        }

        .man-sep-bar {
            width: 4px;
            background: #0f172a;
            align-self: stretch;
            min-height: 32px;
            flex-shrink: 0;
        }

        .man-sep-content {
            flex: 1;
            padding: 8px 14px;
            background: #FCEAEA;
            border: 1.5px solid #e2e8f0;
            border-left: none;
            border-radius: 0 8px 8px 0;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Glosario cards */
        .glos-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 14px;
        }

        .glos-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 11px 13px;
            border-left: 3px solid #0f172a;
        }

        .glos-term {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .glos-def {
            font-size: 10.5px;
            color: var(--muted);
            line-height: 1.5;
            font-weight: 600;
        }

        /* Principios cards */
        .princ-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .princ-card {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 15px;
            text-align: center;
        }

        .princ-num {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0f172a;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
        }

        .princ-title {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .princ-body {
            font-size: 10.5px;
            color: var(--muted);
            line-height: 1.5;
            font-weight: 600;
        }

        /* Componentes COSO */
        .coso-accordion {
            margin-bottom: 8px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .coso-hdr {
            background: #fff;
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background .15s;
        }

        .coso-hdr:hover {
            background: #FCEAEA;
        }

        .coso-hdr.open {
            background: #FCEAEA;
            border-bottom: 1px solid #e2e8f0;
        }

        .coso-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #0f172a;
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .coso-hdr-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            flex: 1;
        }

        .coso-hdr-badge {
            font-size: 9px;
            padding: 2px 8px;
            background: #FCEAEA;
            color: #0f172a;
            border-radius: 10px;
            font-weight: 800;
            border: 1px solid #e2e8f0;
        }

        .coso-arr {
            font-size: 14px;
            color: #0f172a;
            transition: transform .2s;
        }

        .coso-arr.open {
            transform: rotate(90deg);
        }

        .coso-body {
            display: none;
            padding: 14px 16px;
            background: #fff;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.65;
            font-weight: 600;
        }

        .coso-body.open {
            display: block;
        }

        .coso-sub {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            margin: 10px 0 5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Valores chips */
        .valor-chip {
            display: inline-block;
            background: #FCEAEA;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            margin: 3px;
        }

        /* Objetivo card */
        .obj-main {
            background: linear-gradient(135deg, #0f172a 0%, #0b1220 100%);
            border-radius: 10px;
            padding: 16px 18px;
            margin-bottom: 12px;
            color: #fff;
        }

        .obj-main-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: .75;
            margin-bottom: 6px;
        }

        .obj-main-text {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.65;
        }

        /* Específicos */
        .obj-esp {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 9px 12px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 7px;
            border-left: 3px solid #0f172a;
        }

        .obj-esp-num {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0f172a;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .obj-esp-text {
            font-size: 11.5px;
            color: var(--text);
            font-weight: 600;
            line-height: 1.5;
        }

        /* Roles */
        .rol-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-left: 4px solid #0f172a;
        }

        .rol-title {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .rol-body {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.55;
            font-weight: 600;
        }

        /* Herramientas supervisión */
        .herr-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .herr-card {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 15px;
        }

        .herr-num {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .herr-title {
            font-size: 12px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 5px;
        }

        .herr-body {
            font-size: 10.5px;
            color: var(--muted);
            line-height: 1.5;
            font-weight: 600;
        }

        /* Organigrama */
        .org-wrap {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            padding: 16px;
            overflow-x: auto;
        }

        .org-box {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
        }

        .org-node {
            background: #0f172a;
            color: #fff;
            border-radius: 7px;
            padding: 7px 14px;
            font-size: 10.5px;
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
            min-width: 130px;
        }

        .org-node.sub {
            background: #FCEAEA;
            color: #0f172a;
            border: 1.5px solid #e2e8f0;
        }

        .org-node.dir {
            background: #0b1220;
            color: #fff;
        }

        .org-node.cargo {
            background: #fff;
            color: var(--muted);
            border: 1px solid #e2e8f0;
            font-size: 9.5px;
            padding: 4px 10px;
            min-width: 110px;
        }

        .org-line {
            width: 2px;
            background: #e2e8f0;
            height: 16px;
            margin: 0 auto;
        }

        .org-h-line {
            height: 2px;
            background: #e2e8f0;
            flex: 1;
            min-width: 20px;
        }

        .org-row {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 0;
        }

        .org-col {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .org-dirs {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            margin-top: 14px;
        }

        .org-dir-card {
            background: #0b1220;
            color: #fff;
            border-radius: 7px;
            padding: 8px 7px;
            font-size: 9px;
            font-weight: 700;
            text-align: center;
            line-height: 1.4;
        }

        .org-cargos {
            margin-top: 4px;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .org-cargo-item {
            background: #FCEAEA;
            color: #0f172a;
            border-radius: 4px;
            padding: 3px 6px;
            font-size: 8.5px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        /* Política */
        .pol-box {
            background: linear-gradient(135deg, #FCEAEA 0%, #fff 100%);
            border: 2px solid #0f172a;
            border-radius: 10px;
            padding: 16px 18px;
            margin-bottom: 12px;
        }

        .pol-title {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .pol-body {
            font-size: 12px;
            color: var(--text);
            line-height: 1.7;
            font-weight: 600;
        }

        /* Marco normativo timeline */
        .norm-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 9px 0;
            border-bottom: 1px solid #FCEAEA;
        }

        .norm-item:last-child {
            border-bottom: none;
        }

        .norm-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #0f172a;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .norm-body {
            font-size: 11.5px;
            color: var(--text);
            font-weight: 600;
            line-height: 1.5;
        }

        .norm-body strong {
            color: #0f172a;
        }

        /* Efectividad */
        .efec-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .efec-card {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            text-align: center;
        }

        .efec-icon {
            font-size: 24px;
            margin-bottom: 6px;
        }

        .efec-title {
            font-size: 11.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .efec-body {
            font-size: 10px;
            color: var(--muted);
            line-height: 1.5;
            font-weight: 600;
        }

        @media(max-width:700px) {
            .man-chapters {
                grid-template-columns: 1fr
            }

            .glos-grid {
                grid-template-columns: 1fr
            }

            .princ-grid {
                grid-template-columns: 1fr 1fr
            }

            .efec-grid {
                grid-template-columns: 1fr
            }

            .herr-grid {
                grid-template-columns: 1fr
            }

            .org-dirs {
                grid-template-columns: repeat(2, 1fr)
            }
        }
    </style>



    <!-- ESTILOS MANUAL -->
    <style>
        .mn-hero {
            background: linear-gradient(135deg, #0f172a 0%, #0b1220 100%);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 16px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid #06b6d4;
        }

        .mn-hero::after {
            content: 'MA-DE-01';
            position: absolute;
            right: 16px;
            bottom: 8px;
            font-size: 48px;
            font-weight: 900;
            opacity: .06;
            letter-spacing: -1px;
        }

        .mn-eyebrow {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: .75;
            margin-bottom: 5px;
        }

        .mn-title {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .mn-meta {
            font-size: 11px;
            opacity: .82;
            margin-bottom: 13px;
        }

        .mn-badge {
            display: inline-block;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .3);
            padding: 3px 11px;
            border-radius: 4px;
            font-size: 9.5px;
            font-weight: 700;
            margin-right: 5px;
            margin-bottom: 3px;
        }

        /* Índice lateral + contenido */
        .mn-layout {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 14px;
            align-items: start;
        }

        .mn-index {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            position: sticky;
            top: 10px;
        }

        .mn-index-hdr {
            background: #0f172a;
            color: #fff;
            padding: 10px 14px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .mn-idx-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 9px 14px;
            border: none;
            background: #fff;
            text-align: left;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
            color: #3D4543;
            border-bottom: 1px solid #f1f5f9;
            transition: all .15s;
            font-family: inherit;
        }

        .mn-idx-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .mn-idx-btn.mn-active {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 800;
            border-left: 3px solid #0f172a;
        }

        .mn-idx-icon {
            font-size: 13px;
            flex-shrink: 0;
            width: 18px;
        }

        .mn-idx-num {
            font-size: 9px;
            font-weight: 800;
            color: #06b6d4;
            display: block;
            margin-bottom: 1px;
        }

        /* Panel de contenido */
        #sManual .mn-panel-hidden {
            display: none;
        }

        .mn-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px 18px;
            margin-bottom: 12px;
        }

        .mn-card-title {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 11px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .mn-sep {
            height: 2px;
            background: linear-gradient(90deg, #0f172a, #06b6d4, transparent);
            border-radius: 2px;
            margin: 14px 0 11px;
        }

        /* Glosario */
        .mn-glos-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .mn-glos-item {
            background: #f1f5f9;
            border-radius: 7px;
            padding: 10px 12px;
            border-left: 3px solid #0f172a;
        }

        .mn-glos-term {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .mn-glos-def {
            font-size: 10px;
            color: #4A6260;
            line-height: 1.5;
            font-weight: 600;
        }

        /* Objetivos */
        .mn-obj-main {
            background: linear-gradient(135deg, #0f172a, #0b1220);
            border-radius: 9px;
            padding: 14px 16px;
            color: #fff;
            margin-bottom: 10px;
        }

        .mn-obj-lbl {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            opacity: .75;
            margin-bottom: 5px;
        }

        .mn-obj-txt {
            font-size: 12px;
            line-height: 1.65;
            font-weight: 500;
        }

        .mn-obj-esp {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 9px 12px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            margin-bottom: 7px;
            border-left: 3px solid #0f172a;
        }

        .mn-obj-num {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #0f172a;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .mn-obj-body {
            font-size: 11px;
            color: #1A2826;
            font-weight: 600;
            line-height: 1.5;
        }

        .mn-obj-body strong {
            color: #0f172a;
        }

        /* Principios */
        .mn-princ-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 9px;
            margin-bottom: 12px;
        }

        .mn-princ {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            padding: 13px 14px;
            text-align: center;
        }

        .mn-princ-n {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #0f172a;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 7px;
        }

        .mn-princ-t {
            font-size: 11.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .mn-princ-b {
            font-size: 10px;
            color: #4A6260;
            line-height: 1.5;
            font-weight: 600;
        }

        /* Efectividad */
        .mn-efec-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 9px;
        }

        .mn-efec {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            padding: 13px;
            text-align: center;
        }

        .mn-efec-icon {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .mn-efec-t {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .mn-efec-b {
            font-size: 10px;
            color: #4A6260;
            line-height: 1.5;
            font-weight: 600;
        }

        /* COSO acordeones */
        .mn-coso {
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            margin-bottom: 8px;
            overflow: hidden;
        }

        .mn-coso-hdr {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 15px;
            background: #fff;
            cursor: pointer;
            transition: background .15s;
        }

        .mn-coso-hdr:hover {
            background: #f1f5f9;
        }

        .mn-coso-hdr.mn-open {
            background: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
        }

        .mn-coso-n {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #0f172a;
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mn-coso-t {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A2826;
            flex: 1;
        }

        .mn-coso-badge {
            font-size: 9px;
            padding: 2px 8px;
            background: #f1f5f9;
            color: #0f172a;
            border-radius: 8px;
            font-weight: 800;
            border: 1px solid #e2e8f0;
        }

        .mn-coso-arr {
            font-size: 12px;
            color: #0f172a;
            transition: transform .2s;
            flex-shrink: 0;
        }

        .mn-coso-arr.mn-open {
            transform: rotate(90deg);
        }

        .mn-coso-body {
            display: none;
            padding: 13px 16px;
            background: #fff;
            font-size: 11px;
            color: #4A6260;
            line-height: 1.65;
            font-weight: 600;
        }

        .mn-coso-body.mn-open {
            display: block;
        }

        .mn-coso-sub {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            margin: 10px 0 5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .mn-valor {
            display: inline-block;
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 10.5px;
            font-weight: 800;
            margin: 2px;
        }

        .mn-factor {
            background: #f1f5f9;
            border-radius: 6px;
            padding: 7px 11px;
            border-left: 3px solid #0f172a;
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .mn-herr {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 7px;
        }

        .mn-herr-n {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .mn-herr-t {
            font-size: 11.5px;
            font-weight: 800;
            color: #1A2826;
            margin-bottom: 3px;
        }

        .mn-herr-b {
            font-size: 10.5px;
            color: #4A6260;
            line-height: 1.5;
            font-weight: 600;
        }

        /* Organigrama */
        .mn-org {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            overflow-x: auto;
        }

        .mn-org-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .mn-org-box {
            background: #0f172a;
            color: #fff;
            border-radius: 7px;
            padding: 7px 16px;
            font-size: 10.5px;
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
        }

        .mn-org-box.dark {
            background: #4A0A18;
        }

        .mn-org-box.med {
            background: #0b1220;
        }

        .mn-org-box.light {
            background: #f1f5f9;
            color: #0f172a;
            border: 1.5px solid #e2e8f0;
            font-size: 10px;
        }

        .mn-org-box.cargo {
            background: #fff;
            color: #4A6260;
            border: 1px solid #e2e8f0;
            font-size: 9.5px;
            padding: 4px 10px;
        }

        .mn-org-line {
            width: 2px;
            height: 14px;
            background: #e2e8f0;
            margin: 0 auto;
        }

        .mn-org-dirs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 7px;
            margin-top: 12px;
        }

        .mn-org-dir {
            background: #0b1220;
            color: #fff;
            border-radius: 7px;
            padding: 8px 8px;
            font-size: 9px;
            font-weight: 700;
            text-align: center;
            line-height: 1.35;
        }

        .mn-org-cargos {
            margin-top: 4px;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .mn-org-cargo {
            background: #f1f5f9;
            color: #0f172a;
            border-radius: 4px;
            padding: 3px 6px;
            font-size: 8.5px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        /* Roles */
        .mn-rol {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 8px;
            border-left: 4px solid #0f172a;
        }

        .mn-rol-t {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .mn-rol-b {
            font-size: 11px;
            color: #4A6260;
            line-height: 1.55;
            font-weight: 600;
        }

        /* Tabla normativa */
        .mn-norm {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .mn-norm:last-child {
            border-bottom: none;
        }

        .mn-norm-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #0f172a;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .mn-norm-body {
            font-size: 11px;
            color: #1A2826;
            font-weight: 600;
            line-height: 1.5;
        }

        .mn-norm-body strong {
            color: #0f172a;
        }

        /* Política */
        .mn-pol {
            background: linear-gradient(135deg, #f1f5f9, #fff);
            border: 2px solid #0f172a;
            border-radius: 9px;
            padding: 14px 16px;
            margin-bottom: 10px;
        }

        .mn-pol-lbl {
            font-size: 9.5px;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .mn-pol-txt {
            font-size: 11.5px;
            color: #1A2826;
            line-height: 1.7;
            font-weight: 600;
        }

        /* Anexos */
        .mn-anx-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        .mn-anx {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            padding: 14px;
            text-align: center;
        }

        .mn-anx-icon {
            font-size: 28px;
            margin-bottom: 7px;
        }

        .mn-anx-t {
            font-size: 11.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .mn-anx-b {
            font-size: 10px;
            color: #4A6260;
            line-height: 1.5;
            font-weight: 600;
        }

        .mn-anx-code {
            display: inline-block;
            background: #f1f5f9;
            color: #0f172a;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 800;
            margin-top: 6px;
            border: 1px solid #e2e8f0;
        }

        /* Versiones */
        .mn-ver-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .mn-ver-table th {
            background: #0f172a;
            color: #fff;
            padding: 8px 12px;
            text-align: left;
            font-size: 9.5px;
            font-weight: 800;
            border: 1px solid #0b1220;
        }

        .mn-ver-table td {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            color: #1A2826;
            font-weight: 600;
        }

        /* Confidencial */
        .mn-conf {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 12px;
        }

        .mn-conf-icon {
            font-size: 18px;
            flex-shrink: 0;
        }

        .mn-conf-txt {
            font-size: 11px;
            color: #0f172a;
            font-weight: 700;
            line-height: 1.6;
        }

        @media(max-width:700px) {
            .mn-layout {
                grid-template-columns: 1fr;
            }

            .mn-index {
                position: static;
            }

            .mn-glos-grid,
            .mn-princ-grid,
            .mn-efec-grid,
            .mn-org-dirs,
            .mn-anx-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
    <style>
        :root {
            --blue: #0F52A0;
            --blue-dark: #0A3A74;
            --blue-light: #E6F1FB;
            --extreme: #C0392B;
            --high: #E67E22;
            --moderate: #F1C40F;
            --low: #27AE60;
            --surface: #fff;
            --bg: #f4f6f8;
            --border: #e2e6ea;
            --text: #1a1a1a;
            --muted: #6c757d;
            --radius: 10px;
            /* Enlace Global brand palette */
            --eg-teal: #00BAC3;
            --eg-teal-d: #008A91;
            --eg-teal-l: #E0F8F9;
            --eg-teal-m: #9FE2E5;
            --eg-green: #00AE8D;
            --eg-green-l: #E0F5F0;
            --eg-green-d: #007A62;
            --eg-orange: #FF9E18;
            --eg-orange-l: #FFF4DC;
            --eg-pink: #E81F76;
            --eg-dark: #3D4543;
            --eg-dark2: #222E2C;
            --red: #C93535;
            --red-l: #FCEAEA;
            --red-m: #F5A5A5;
            --amber: #D97A0A;
            --amber-l: #FEF3E2;
        }

        /* ── SECCIÓN MINERÍA / ENLACE ── */
        .min-hero {
            background: linear-gradient(135deg, #4AAEB7 0%, #00BAC3 55%, #00AE8D 100%);
            border-radius: var(--radius);
            padding: 28px 26px;
            margin-bottom: 18px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .min-hero::before {
            content: '⛏️';
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 72px;
            opacity: .12;
        }

        .min-hero-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .min-hero-sub {
            font-size: 12px;
            opacity: .9;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .min-badge {
            display: inline-block;
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .4);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            margin-right: 7px;
            margin-bottom: 5px;
        }

        .min-kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
            margin-bottom: 18px;
        }

        .min-kpi {
            background: #fff;
            border-radius: var(--radius);
            padding: 13px 15px;
            border: 1.5px solid var(--eg-teal-m);
        }

        .min-kpi-label {
            font-size: 10px;
            color: var(--eg-teal-d);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 700;
        }

        .min-kpi-val {
            font-size: 22px;
            font-weight: 800;
            color: var(--eg-dark);
        }

        .min-kpi-val.crit {
            color: var(--red);
        }

        .min-kpi-val.teal {
            color: var(--eg-teal-d);
        }

        .min-kpi-sub {
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px;
        }

        .min-card {
            background: #fff;
            border: 1.5px solid var(--eg-teal-m);
            border-radius: var(--radius);
            padding: 16px 18px;
            margin-bottom: 14px;
        }

        .min-card-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--eg-dark);
            margin-bottom: 12px;
            padding-bottom: 9px;
            border-bottom: 2px solid var(--eg-teal-l);
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .min-card-title .ct-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .two-col-min {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .bar-row-min {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 7px;
        }

        .bar-lbl-min {
            font-size: 11px;
            color: var(--muted);
            width: 190px;
            flex-shrink: 0;
            font-weight: 600;
        }

        .bar-track-min {
            flex: 1;
            height: 8px;
            background: #f0f4f4;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid var(--eg-teal-m);
        }

        .bar-fill-min {
            height: 100%;
            border-radius: 4px;
        }

        .bar-val-min {
            font-size: 10px;
            font-weight: 800;
            min-width: 34px;
            text-align: right;
        }

        .alert-min {
            border-radius: 8px;
            padding: 11px 14px;
            margin-bottom: 9px;
            border-left: 4px solid;
        }

        .am-red {
            background: var(--red-l);
            border-color: var(--red);
        }

        .am-amber {
            background: var(--amber-l);
            border-color: var(--amber);
        }

        .am-teal {
            background: var(--eg-teal-l);
            border-color: var(--eg-teal);
        }

        .am-title {
            font-size: 11.5px;
            font-weight: 800;
            color: var(--eg-dark);
            margin-bottom: 3px;
        }

        .am-body {
            font-size: 10.5px;
            color: var(--muted);
            line-height: 1.55;
            font-weight: 600;
        }

        .stat-row-min {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 0;
            border-bottom: 1px solid var(--eg-teal-l);
            font-size: 11px;
        }

        .stat-row-min:last-child {
            border-bottom: none;
        }

        .stat-val-min {
            font-weight: 800;
            color: var(--text);
        }

        .news-grid-min {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .nc-min {
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 13px 15px;
            position: relative;
            overflow: hidden;
        }

        .nc-min::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .nc-red::before {
            background: var(--red);
        }

        .nc-amber::before {
            background: var(--amber);
        }

        .nc-teal::before {
            background: var(--eg-teal);
        }

        .nc-green::before {
            background: var(--eg-green);
        }

        .nc-src-min {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        .src-tag {
            font-size: 9px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .st-red {
            background: var(--red-l);
            color: #7A1A1A;
        }

        .st-fatf {
            background: var(--eg-teal-l);
            color: #005A5E;
        }

        .st-news {
            background: var(--amber-l);
            color: #7A4800;
        }

        .st-green {
            background: var(--eg-green-l);
            color: var(--eg-green-d);
        }

        .nc-date-min {
            font-size: 9px;
            color: var(--muted);
            margin-left: auto;
            font-weight: 600;
        }

        .nc-title-min {
            font-size: 12px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .nc-body-min {
            font-size: 10px;
            color: var(--muted);
            line-height: 1.55;
            font-weight: 600;
        }

        .nc-tag-min {
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 800;
            margin-top: 6px;
            display: inline-block;
        }

        .nct-r {
            background: var(--red-l);
            color: #7A1A1A;
        }

        .nct-a {
            background: var(--amber-l);
            color: #7A4800;
        }

        .nct-t {
            background: var(--eg-teal-l);
            color: #005A5E;
        }

        .nct-g {
            background: var(--eg-green-l);
            color: var(--eg-green-d);
        }

        .sep-min {
            display: flex;
            align-items: center;
            gap: 0;
            margin: 20px 0 14px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 186, 195, .1);
        }

        .sep-min-bar {
            width: 5px;
            flex-shrink: 0;
            align-self: stretch;
            min-height: 34px;
        }

        .sep-min-content {
            flex: 1;
            padding: 9px 16px;
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1.5px solid;
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        .sep-teal-v .sep-min-bar {
            background: var(--eg-teal);
        }

        .sep-teal-v .sep-min-content {
            background: var(--eg-teal-l);
            border-color: var(--eg-teal-m);
            color: var(--eg-teal-d);
        }

        .sep-green-v .sep-min-bar {
            background: var(--eg-green);
        }

        .sep-green-v .sep-min-content {
            background: var(--eg-green-l);
            border-color: #9FD9C8;
            color: var(--eg-green-d);
        }

        .sep-orange-v .sep-min-bar {
            background: var(--eg-orange);
        }

        .sep-orange-v .sep-min-content {
            background: var(--eg-orange-l);
            border-color: #FAC36A;
            color: #7A4400;
        }

        .sep-red-v .sep-min-bar {
            background: var(--red);
        }

        .sep-red-v .sep-min-content {
            background: var(--red-l);
            border-color: var(--red-m);
            color: #7A1A1A;
        }

        .sep-dark-v .sep-min-bar {
            background: var(--eg-dark);
        }

        .sep-dark-v .sep-min-content {
            background: #F2F4F4;
            border-color: #C8D4D4;
            color: var(--eg-dark);
        }

        .fraud-table-min {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 14px;
        }

        .fraud-table-min th {
            padding: 8px 11px;
            text-align: left;
            font-weight: 800;
            font-size: 9.5px;
            letter-spacing: .4px;
            text-transform: uppercase;
            border: 1px solid var(--border);
            background: var(--eg-teal-l);
            color: var(--eg-teal-d);
        }

        .fraud-table-min td {
            padding: 8px 11px;
            border: 1px solid var(--border);
            vertical-align: middle;
            font-weight: 600;
            color: var(--text);
        }

        .fraud-table-min tr:nth-child(even) td {
            background: #FAFCFD;
        }

        .fraud-table-min tr:hover td {
            background: var(--eg-teal-l);
        }

        .crit-alto {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--red-l);
            color: var(--red);
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 800;
        }

        .crit-medio {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--amber-l);
            color: var(--amber);
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 800;
        }

        .crit-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .tl-wrap {
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
            margin-bottom: 14px;
        }

        .tl-wrap::before {
            content: '';
            position: absolute;
            left: 40px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--eg-teal), var(--eg-green));
            opacity: .35;
        }

        .tl-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            position: relative;
        }

        .tl-year {
            width: 78px;
            flex-shrink: 0;
            background: var(--eg-teal);
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            padding: 3px 7px;
            border-radius: 5px;
            text-align: center;
            position: relative;
            z-index: 1;
            margin-top: 2px;
            box-shadow: 0 2px 8px rgba(0, 186, 195, .25);
        }

        .tl-year.yr-red {
            background: var(--red);
        }

        .tl-year.yr-amber {
            background: var(--amber);
        }

        .tl-year.yr-green {
            background: var(--eg-green);
        }

        .tl-body {
            flex: 1;
            font-size: 11px;
            color: var(--text);
            font-weight: 600;
            line-height: 1.55;
        }

        .tl-body strong {
            color: var(--eg-teal-d);
            font-weight: 800;
        }

        .tl-src {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            margin-top: 2px;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .ctrl-grid-min {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .ctrl-card-min {
            border-radius: 8px;
            padding: 12px 14px;
            border-left: 3px solid;
        }

        .cc-teal {
            background: var(--eg-teal-l);
            border-color: var(--eg-teal);
        }

        .cc-green {
            background: var(--eg-green-l);
            border-color: var(--eg-green);
        }

        .cc-orange {
            background: var(--eg-orange-l);
            border-color: var(--eg-orange);
        }

        .cc-red {
            background: var(--red-l);
            border-color: var(--red);
        }

        .cc-title {
            font-size: 10.5px;
            font-weight: 800;
            color: var(--eg-dark);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cc-body {
            font-size: 10px;
            color: var(--muted);
            line-height: 1.5;
            font-weight: 600;
        }

        /* APD */
        .apd-wrap {
            border: 2px solid var(--eg-teal-m);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 186, 195, .12);
            margin-bottom: 16px;
        }

        .apd-hdr {
            background: linear-gradient(135deg, #4AAEB7 0%, #00BAC3 60%, #00AE8D 100%);
            padding: 16px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid rgba(255, 255, 255, .2);
        }

        .apd-hdr-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .apd-shield {
            width: 40px;
            height: 40px;
            border-radius: 9px;
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .apd-hdr-title {
            font-size: 13px;
            font-weight: 900;
            color: #fff;
        }

        .apd-hdr-sub {
            font-size: 10px;
            color: rgba(255, 255, 255, .88);
            font-weight: 600;
            margin-top: 1px;
        }

        .apd-hdr-badges {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .apd-hdr-badge {
            font-size: 8.5px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
            padding: 3px 9px;
            border-radius: 4px;
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .4);
            color: #fff;
        }

        .apd-body-wrap {
            padding: 20px 22px;
            background: #fff;
        }

        .apd-grid-min {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        .apd-card-min {
            border-radius: 10px;
            padding: 14px 16px;
            border: 1.5px solid;
            position: relative;
            overflow: hidden;
        }

        .apd-card-min::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            bottom: 0;
        }

        .apc-teal {
            background: var(--eg-teal-l);
            border-color: var(--eg-teal-m);
        }

        .apc-teal::before {
            background: var(--eg-teal);
        }

        .apc-green {
            background: var(--eg-green-l);
            border-color: #9FD9C8;
        }

        .apc-green::before {
            background: var(--eg-green);
        }

        .apc-red {
            background: var(--red-l);
            border-color: var(--red-m);
        }

        .apc-red::before {
            background: var(--red);
        }

        .apc-amber {
            background: var(--amber-l);
            border-color: #FAC36A;
        }

        .apc-amber::before {
            background: var(--amber);
        }

        .apc-head {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-bottom: 9px;
        }

        .apc-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .apc-icon-teal {
            background: rgba(0, 186, 195, .2);
        }

        .apc-icon-green {
            background: rgba(0, 174, 141, .2);
        }

        .apc-icon-red {
            background: rgba(201, 53, 53, .15);
        }

        .apc-icon-amber {
            background: rgba(217, 122, 10, .15);
        }

        .apc-title {
            font-size: 11.5px;
            font-weight: 900;
            color: var(--eg-dark);
            line-height: 1.3;
        }

        .apc-code {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            margin-top: 2px;
        }

        .apc-steps {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .apc-step {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            font-size: 10.5px;
            color: var(--text);
            font-weight: 600;
            line-height: 1.45;
        }

        .step-chk {
            width: 17px;
            height: 17px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            flex-shrink: 0;
            margin-top: 1px;
            font-weight: 800;
        }

        .chk-teal {
            background: var(--eg-teal);
            color: #fff;
        }

        .chk-green {
            background: var(--eg-green);
            color: #fff;
        }

        .chk-red {
            background: var(--red);
            color: #fff;
        }

        .chk-amber {
            background: var(--amber);
            color: #fff;
        }

        .apd-footer-bar {
            background: linear-gradient(135deg, #4AAEB7 0%, #00AE8D 100%);
            border-radius: 10px;
            padding: 14px 18px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        .apdf-item {
            display: flex;
            align-items: flex-start;
            gap: 9px;
        }

        .apdf-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .apdf-title {
            font-size: 11px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 2px;
        }

        .apdf-body {
            font-size: 9.5px;
            color: rgba(255, 255, 255, .92);
            line-height: 1.5;
            font-weight: 600;
        }

        .apd-escalation {
            background: rgba(201, 53, 53, .08);
            border: 1px solid rgba(201, 53, 53, .25);
            border-radius: 8px;
            padding: 11px 15px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .esc-title {
            font-size: 11px;
            font-weight: 800;
            color: var(--red);
        }

        .esc-sub {
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px;
            font-weight: 600;
        }

        /* Heatmap modal */
        .hm-grid-min {
            display: grid;
            grid-template-columns: 85px repeat(4, 1fr);
            gap: 4px;
            font-size: 10.5px;
            margin-bottom: 10px;
        }

        .hm-lbl-min {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 7px;
            color: var(--muted);
            font-weight: 700;
            font-size: 9.5px;
        }

        .hm-head-min {
            text-align: center;
            font-weight: 800;
            color: var(--eg-dark);
            padding: 5px;
            font-size: 9.5px;
        }

        .hm-cell-min {
            border-radius: 7px;
            padding: 8px 4px;
            text-align: center;
            font-size: 9px;
            font-weight: 700;
            line-height: 1.3;
            cursor: default;
            position: relative;
        }

        .hm-critical-min {
            background: #F09595;
            color: #501313;
        }

        .hm-high-min {
            background: #FAC775;
            color: #412402;
        }

        .hm-medium-min {
            background: #B5D4F4;
            color: #042C53;
        }

        .hm-low-min {
            background: #AADDD6;
            color: #034A44;
        }

        .hm-nil-min {
            background: #f4f6f8;
            color: #888;
        }

        .min-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 30, 30, .65);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(3px);
        }

        .min-modal-overlay.open {
            display: flex;
        }

        .min-modal {
            background: #fff;
            border-radius: 14px;
            width: 100%;
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 28px 64px rgba(0, 0, 0, .3);
        }

        .min-modal-head {
            background: var(--eg-dark2);
            padding: 14px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 14px 14px 0 0;
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 3px solid var(--eg-teal);
        }

        .min-modal-title {
            color: #fff;
            font-size: 12px;
            font-weight: 800;
        }

        .min-modal-close {
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s;
        }

        .min-modal-close:hover {
            background: rgba(255, 255, 255, .3);
        }

        .min-modal-body {
            padding: 20px 22px;
        }

        .plan-table-min {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .plan-table-min th {
            background: var(--eg-teal-l);
            padding: 7px 10px;
            text-align: left;
            font-weight: 800;
            color: var(--eg-teal-d);
            font-size: 9.5px;
            border: 1px solid var(--border);
            letter-spacing: .3px;
        }

        .plan-table-min td {
            padding: 7px 10px;
            border: 1px solid var(--border);
            vertical-align: middle;
            color: var(--text);
            font-weight: 600;
        }

        .plan-table-min tr:nth-child(even) td {
            background: #FAFCFD;
        }

        .plan-table-min tr:hover td {
            background: var(--eg-teal-l);
        }

        .plazo-tag {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9.5px;
            background: var(--eg-teal-l);
            color: var(--eg-dark);
            font-weight: 800;
            border: 1px solid var(--eg-teal-m);
        }

        .pill-min-r {
            background: var(--red-l);
            color: #7A1A1A;
            display: inline-block;
            padding: 2px 9px;
            border-radius: 10px;
            font-size: 9.5px;
            font-weight: 800;
        }

        .pill-min-a {
            background: var(--amber-l);
            color: #7A4800;
            display: inline-block;
            padding: 2px 9px;
            border-radius: 10px;
            font-size: 9.5px;
            font-weight: 800;
        }

        @media(max-width:700px) {

            .two-col-min,
            .news-grid-min,
            .ctrl-grid-min,
            .apd-grid-min,
            .apd-footer-bar {
                grid-template-columns: 1fr;
            }

            .min-modal {
                max-width: 100%;
            }
        }

        /* nav-tab teal variant for mining */
        .nav-tab.mining {
            border-color: var(--eg-teal-m);
            color: var(--eg-teal-d);
        }

        .nav-tab.mining:hover {
            background: var(--eg-teal-l);
            color: var(--eg-teal-d);
            border-color: var(--eg-teal);
        }

        .nav-tab.mining.active {
            background: var(--eg-teal);
            border-color: var(--eg-teal);
            color: #fff;
        }

        /* home nav btn teal */
        .nav-home-btn.teal-btn {
            border-color: var(--eg-teal-m);
        }

        .nav-home-btn.teal-btn:hover {
            border-color: var(--eg-teal);
            background: var(--eg-teal-l);
        }

        .nav-home-btn.teal-btn i {
            color: var(--eg-teal-d);
        }

        /* fraud resumen */
        .fraud-resumen-min {
            background: linear-gradient(135deg, var(--eg-teal-l) 0%, var(--eg-green-l) 100%);
            border: 1.5px solid var(--eg-teal-m);
            border-radius: 10px;
            padding: 13px 17px;
            margin-bottom: 13px;
        }

        .fraud-resumen-title-min {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--eg-teal-d);
            margin-bottom: 6px;
        }

        .fraud-resumen-body-min {
            font-size: 11.5px;
            color: var(--text);
            line-height: 1.65;
            font-weight: 600;
        }

        .fraud-resumen-body-min strong {
            color: var(--eg-teal-d);
        }

        .wrapper {
            max-width: 900px;
            margin: 0 auto;
            padding: 24px 16px;
        }

        /* Naples Prime — #0f172a borgoña principal · #0b1220 oscuro · #06b6d4 acento */
        .top-bar {
            background: linear-gradient(135deg, #0f172a 0%, #0b1220 100%);
            color: #fff;
            padding: 0;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            border-bottom: 3px solid #06b6d4;
        }

        .top-bar-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            text-align: center;
            position: relative;
        }

        .top-bar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        .top-bar-logo svg {
            width: 36px;
            height: 36px;
            filter: drop-shadow(0 1px 4px rgba(0, 0, 0, .2));
        }

        .top-bar-title {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: .4px;
            color: #fff;
            line-height: 1.2;
            text-align: center;
        }

        .top-bar-meta {
            font-size: 12px;
            font-weight: 300;
            letter-spacing: .7px;
            color: rgba(255, 255, 255, .8);
            text-align: center;
            margin-top: 5px;
            font-style: italic;
        }

        .nav-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
            background: #fff;
            padding: 10px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
        }

        .nav-tab {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all .15s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-tab:hover {
            background: #ecfeff;
            color: #0f172a;
        }

        .nav-tab.active {
            background: #0f172a;
            color: #fff;
            border-color: #0f172a;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .hero {
            background: linear-gradient(135deg, #0f172a 0%, #0b1220 100%);
            border-radius: var(--radius);
            padding: 16px 28px 14px;
            margin-bottom: 18px;
            color: #fff;
            text-align: center;
            border-bottom: 3px solid #06b6d4;
        }

        .hero-title {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: .7;
            margin-bottom: 6px;
            text-align: center;
        }

        .hero-sub {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.25;
            margin-bottom: 0;
            text-align: center;
            letter-spacing: .2px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .3);
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            margin-right: 8px;
            margin-bottom: 6px;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
            margin-bottom: 18px;
        }

        .kpi {
            background: #fff;
            border-radius: var(--radius);
            padding: 10px 12px;
            border: 1px solid var(--border);
        }

        .kpi-label {
            font-size: 9.5px;
            color: var(--muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .kpi-val {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
        }

        .kpi-val.extreme {
            color: var(--extreme);
        }

        .kpi-val.high {
            color: var(--high);
        }

        .kpi-sub {
            font-size: 9.5px;
            color: var(--muted);
            margin-top: 2px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            margin-bottom: 14px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .risk-table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
        }

        .risk-table th {
            text-align: left;
            padding: 8px 10px;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            background: #f8f9fa;
        }

        .risk-table td {
            padding: 7px 10px;
            border-bottom: 1px solid #f0f0f0;
            color: var(--text);
            vertical-align: top;
        }

        .risk-table tr:last-child td {
            border-bottom: none;
        }

        .risk-table tr:hover td {
            background: #f8f9ff;
        }

        .badge {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        .badge-extreme {
            background: #FCEBEB;
            color: #A32D2D;
        }

        .badge-high {
            background: #FFF3E0;
            color: #E65100;
        }

        .badge-moderate {
            background: #FFFDE7;
            color: #F57F17;
        }

        .badge-low {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .badge-optimal {
            background: #E8F5E9;
            color: #1B5E20;
        }

        .badge-good {
            background: #E3F2FD;
            color: #0D47A1;
        }

        .badge-weak {
            background: #FFF8E1;
            color: #F57F17;
        }

        .badge-inacept {
            background: #FFEBEE;
            color: #B71C1C;
        }

        .critical-card {
            border-left: 4px solid var(--extreme);
            background: #fff;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 8px;
            border: 1px solid #e2e8f0;
            border-left: 4px solid var(--extreme);
        }

        .critical-code {
            font-size: 11px;
            font-weight: 700;
            color: #A32D2D;
            margin-bottom: 3px;
        }

        .critical-desc {
            font-size: 12px;
            color: var(--text);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .critical-meta {
            font-size: 11px;
            color: var(--muted);
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 14px;
        }

        .filter-btn {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--muted);
            font-size: 11px;
            cursor: pointer;
            transition: all .12s;
        }

        .filter-btn.on {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .matrix-grid {
            display: grid;
            grid-template-columns: 90px repeat(5, 1fr);
            gap: 3px;
            font-size: 10px;
            margin-bottom: 10px;
        }

        .mg-head {
            background: var(--blue);
            color: #fff;
            padding: 6px 4px;
            text-align: center;
            border-radius: 4px;
            font-weight: 600;
        }

        .mg-ylabel {
            background: #f0f4fa;
            padding: 6px 8px;
            text-align: right;
            color: var(--muted);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-size: 10px;
        }

        .mg-cell {
            padding: 7px 3px;
            text-align: center;
            border-radius: 4px;
            font-weight: 700;
            font-size: 10px;
        }

        .mg-extreme {
            background: #C0392B;
            color: #fff;
        }

        .mg-high {
            background: #E67E22;
            color: #fff;
        }

        .mg-moderate {
            background: #F1C40F;
            color: #333;
        }

        .mg-low {
            background: #27AE60;
            color: #fff;
        }

        .mg-vlow {
            background: #2ECC71;
            color: #fff;
        }

        .legend-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--muted);
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        .ctrl-bar-wrap {
            margin-bottom: 12px;
        }

        .ctrl-bar-label {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--text);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .ctrl-bar-sub {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .ctrl-bar {
            height: 10px;
            border-radius: 5px;
            background: #eee;
            overflow: hidden;
        }

        .ctrl-bar-fill {
            height: 100%;
            border-radius: 5px;
        }

        .criteria-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 10px;
        }

        .criteria-row {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 7px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .criteria-row:last-child {
            border-bottom: none;
        }

        .criteria-num {
            font-size: 18px;
            font-weight: 700;
            color: var(--blue);
            min-width: 28px;
        }

        .criteria-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }

        .criteria-sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
            line-height: 1.5;
        }

        .nav-home-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .nav-home-btn {
            cursor: pointer;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px 16px;
            display: flex;
            gap: 12px;
            align-items: center;
            transition: all .15s;
            background: #fff;
        }

        .nav-home-btn:hover {
            border-color: var(--blue);
            background: #f0f4fa;
        }

        .nav-home-btn.critical {
            border: 2px solid var(--extreme);
        }

        .nav-home-btn i {
            font-size: 22px;
            color: var(--blue);
        }

        .nav-home-btn.critical i {
            color: var(--extreme);
        }

        .nav-home-btn-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }

        .nav-home-btn-sub {
            font-size: 11px;
            color: var(--muted);
        }

        .nav-home-btn.critical .nav-home-btn-sub {
            color: #A32D2D;
        }

        .process-header {
            background: #e8f0fb;
            padding: 9px 14px;
            border-radius: 8px;
            margin: 12px 0 6px;
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            border-left: 4px solid var(--blue);
        }

        .desc-row {
            border-bottom: 1px solid #f0f0f0;
            padding: 10px 0;
        }

        .desc-row:last-child {
            border-bottom: none;
        }

        .desc-code {
            font-size: 11px;
            font-weight: 700;
            color: var(--blue);
            margin-bottom: 3px;
        }

        .desc-risk {
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            margin: 3px 0;
        }

        .desc-cause {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .desc-resp {
            font-size: 10px;
            padding: 3px 10px;
            background: var(--blue-light);
            color: var(--blue-dark);
            border-radius: 12px;
            display: inline-block;
            font-weight: 500;
        }

        .pf-select {
            width: 100%;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--text);
            font-size: 12px;
            margin-bottom: 14px;
        }

        #thermal-map {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(5, 64px);
            gap: 4px;
        }

        .th-cell {
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3px;
            cursor: default;
            font-size: 8.5px;
            font-weight: 700;
            text-align: center;
            overflow: hidden;
        }

        .th-empty-cell {
            opacity: .18;
            border-radius: 5px;
        }

        .alert-box {
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 10px;
        }

        .alert-extreme {
            background: #FFEBEE;
            border-left: 4px solid var(--extreme);
        }

        .alert-high {
            background: #FFF8E1;
            border-left: 4px solid var(--high);
        }

        .alert-title {
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .alert-extreme .alert-title {
            color: #B71C1C;
        }

        .alert-high .alert-title {
            color: #E65100;
        }

        .alert-body {
            font-size: 11px;
            line-height: 1.6;
        }

        .alert-extreme .alert-body {
            color: #7B1C1C;
        }

        .alert-high .alert-body {
            color: #7B3300;
        }

        .thermal-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 14px;
        }

        .thermal-tab {
            padding: 5px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--muted);
            font-size: 11px;
            cursor: pointer;
        }

        .thermal-tab.on {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .chart-wrap {
            position: relative;
            width: 100%;
            height: 280px;
        }

        footer {
            text-align: center;
            font-size: 11px;
            color: var(--muted);
            margin-top: 24px;
            padding: 16px 0;
            border-top: 1px solid var(--border);
        }

        @media(max-width:600px) {
            .nav-home-grid {
                grid-template-columns: 1fr;
            }

            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <style>
        /* ── Armonización con el sistema visual de la plataforma ── */
        .audit-module { font-family: inherit; color: #0f172a; }
        .audit-module .wrapper { max-width: none; margin: 0; padding: 0; }
        .audit-module .top-bar {
            position: relative;
            border: 0;
            border-radius: 1.5rem;
            background:
                radial-gradient(800px 360px at 10% -30%, rgba(56,189,248,.20), transparent 60%),
                radial-gradient(600px 360px at 100% 130%, rgba(99,102,241,.25), transparent 60%),
                linear-gradient(160deg, #0b1220 0%, #0f172a 60%, #111827 100%);
            box-shadow: 0 1px 2px rgba(15,23,42,.06);
        }
        .audit-module .top-bar-inner { padding: 22px 24px; }
        .audit-module .top-bar-title { font-size: 22px; letter-spacing: -.01em; }
        .audit-module .top-bar-meta { font-style: normal; color: #94a3b8; }
        .audit-module .nav-tabs {
            position: sticky; top: 4.5rem; z-index: 20;
            flex-wrap: nowrap; overflow-x: auto; scrollbar-width: thin;
            border-radius: 1rem; border-color: #e2e8f0;
            background: rgba(255,255,255,.92); backdrop-filter: blur(8px);
            box-shadow: 0 1px 2px rgba(15,23,42,.04);
        }
        .audit-module .nav-tab {
            white-space: nowrap; flex-shrink: 0;
            border-radius: .6rem; border-color: #e2e8f0; color: #475569;
            font-family: inherit; font-weight: 600;
        }
        .audit-module .nav-tab:hover { background: #f1f5f9; color: #0f172a; }
        .audit-module .nav-tab.active,
        .audit-module .nav-tab.mining.active { background: #0f172a !important; color: #fff !important; border-color: #0f172a !important; }
        .audit-module .nav-tab.active i { color: #67e8f9 !important; }
        .audit-module .hero, .audit-module .man-hero, .audit-module .mn-hero { border-bottom: 0; border-radius: 1.25rem; }
    </style>

    <div class="audit-module mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <div>
            <div>
                <div>

                    <div class="wrapper">
                        <div class="wrapper">

                            <div class="top-bar">
                                <div class="top-bar-inner">
                                    <!-- Logo Naples Prime -->
                                    <div class="top-bar-logo">
                                        <svg viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Naples Prime logo">
                                            <rect x="1" y="1" width="50" height="50" rx="4" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" />
                                            <path d="M10 40 L10 12 L22 12 L42 34 L42 12" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 40 L42 40" fill="none" stroke="#06b6d4" stroke-width="2.5" stroke-linecap="round" />
                                        </svg>
                                        <div style="display:flex;flex-direction:column;align-items:center;line-height:1.1;">
                                            <span style="font-size:13px;font-weight:800;letter-spacing:3px;color:#fff;text-transform:uppercase;">NAPLES</span>
                                            <span style="font-size:10px;font-weight:400;letter-spacing:3px;color:#06b6d4;text-transform:uppercase;">PRIME</span>
                                        </div>
                                    </div>
                                    <div class="top-bar-title">Modelo de Control Interno - SCI Naples</div>
                                    <div class="top-bar-meta">Propuesta para implementación de un Sistema de Control Interno</div>
                                </div>
                            </div>

                            <div class="nav-tabs">
                                <button class="nav-tab active" onclick="showSection('home')"><i class="ti ti-home"></i> Inicio</button>
                                <button class="nav-tab" onclick="showSection('s1')" style="border-bottom:3px solid var(--blue);"><i class="ti ti-chart-bar"></i> 1 · Riesgos y Prob.</button>
                                <button class="nav-tab" onclick="showSection('s2')" style="border-bottom:3px solid var(--blue);"><i class="ti ti-file-description"></i> 2 · Descripción</button>
                                <button class="nav-tab" onclick="showSection('s3')" style="border-bottom:3px solid var(--moderate);"><i class="ti ti-table"></i> 3 · Matriz</button>
                                <button class="nav-tab" onclick="showSection('s4')" style="border-bottom:3px solid var(--extreme);"><i class="ti ti-flame"></i> 4 · Mapa Térmico</button>
                                <button class="nav-tab" onclick="showSection('s5')" style="border-bottom:3px solid var(--low);"><i class="ti ti-shield"></i> 5 · Controles</button>
                                <button class="nav-tab" onclick="showSection('s6')" style="border-bottom:3px solid var(--blue);"><i class="ti ti-book"></i> 6 · Criterios</button>
                                <button class="nav-tab mining" onclick="showSection('sMin')" style="border-bottom:3px solid var(--eg-teal);"><i class="ti ti-pickaxe"></i> 7 · LA/FT Minería</button>
                                <button class="nav-tab" onclick="showSection('sManual')" style="border-bottom:3px solid #0f172a;color:#0f172a;border-color:#e2e8f0;" onmouseover="this.style.background='#FCEAEA';this.style.borderColor='#0f172a'" onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#0f172a'"><i class="ti ti-book-2" style="color:#0f172a;"></i> 8 · Manual</button>
                                <button class="nav-tab" style="border-color:#2962B8;color:#2962B8;" onmouseover="this.style.background='#EBF2FF';this.style.borderColor='#2962B8'" onmouseout="this.style.background='#fff';this.style.borderColor='#2962B8'" onclick="showSection('sProp')"><i class="ti ti-clipboard-list" style="color:#2962B8;"></i> 📋 Propuesta</button>
                            </div>

                            <!-- HOME -->
                            <div class="section active" id="home">

                                <!-- HERO -->
                                <div class="hero" style="margin-bottom:22px;">
                                    <div class="hero-sub">Propuesta para implementación de un Sistema de Control Interno</div>
                                </div>

                                <div class="kpi-grid" style="margin-bottom:22px;">
                                    <div class="kpi" style="padding:10px 12px;">
                                        <div class="kpi-label">Total riesgos</div>
                                        <div class="kpi-val" style="font-size:20px;">57</div>
                                        <div class="kpi-sub">RSCI-1 a RSCI-57</div>
                                    </div>
                                    <div class="kpi" style="padding:10px 12px;border-left:4px solid var(--extreme);">
                                        <div class="kpi-label">Zona extrema</div>
                                        <div class="kpi-val extreme" style="font-size:20px;">9</div>
                                        <div class="kpi-sub">Acción inmediata</div>
                                    </div>
                                    <div class="kpi" style="padding:10px 12px;border-left:4px solid var(--high);">
                                        <div class="kpi-label">Zona alta</div>
                                        <div class="kpi-val high" style="font-size:20px;">38</div>
                                        <div class="kpi-sub">Gestión prioritaria</div>
                                    </div>
                                    <div class="kpi" style="padding:10px 12px;border-left:4px solid var(--moderate);">
                                        <div class="kpi-label">Zona moderada</div>
                                        <div class="kpi-val" style="font-size:20px;">10</div>
                                        <div class="kpi-sub">Monitoreo activo</div>
                                    </div>
                                    <div class="kpi" style="padding:10px 12px;border-left:4px solid var(--blue);">
                                        <div class="kpi-label">Procesos vulnerables</div>
                                        <div class="kpi-val" style="font-size:20px;">100%</div>
                                        <div class="kpi-sub">10 de 10 procesos</div>
                                    </div>
                                    <div class="kpi" style="padding:10px 12px;border-left:4px solid var(--blue);">
                                        <div class="kpi-label">Subprocesos vulnerables</div>
                                        <div class="kpi-val" style="font-size:20px;">62%</div>
                                        <div class="kpi-sub">26 de 42 subprocesos</div>
                                    </div>
                                </div>

                                <!-- BLOQUE RESUMEN EJECUTIVO — ocupa el espacio liberado -->
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:22px;">

                                    <!-- Distribución por zona de riesgo -->
                                    <div class="card" style="margin-bottom:0;padding:20px 22px;">
                                        <div class="card-title" style="font-size:13px;"><i class="ti ti-chart-pie" style="color:var(--extreme);"></i> Distribución por zona de riesgo</div>
                                        <div style="display:flex;flex-direction:column;gap:10px;margin-top:4px;">
                                            <div>
                                                <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--muted);margin-bottom:4px;font-weight:600;">
                                                    <span>Zona Extrema (score 13–25)</span><span style="font-weight:800;color:var(--extreme);">9 riesgos · 15.8%</span>
                                                </div>
                                                <div style="height:9px;background:#f0f0f0;border-radius:5px;overflow:hidden;">
                                                    <div style="width:15.8%;height:100%;background:var(--extreme);border-radius:5px;"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--muted);margin-bottom:4px;font-weight:600;">
                                                    <span>Zona Alta (score 6–12)</span><span style="font-weight:800;color:var(--high);">38 riesgos · 66.7%</span>
                                                </div>
                                                <div style="height:9px;background:#f0f0f0;border-radius:5px;overflow:hidden;">
                                                    <div style="width:66.7%;height:100%;background:var(--high);border-radius:5px;"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--muted);margin-bottom:4px;font-weight:600;">
                                                    <span>Zona Moderada (score 2–5)</span><span style="font-weight:800;color:#888;">10 riesgos · 17.5%</span>
                                                </div>
                                                <div style="height:9px;background:#f0f0f0;border-radius:5px;overflow:hidden;">
                                                    <div style="width:17.5%;height:100%;background:var(--moderate);border-radius:5px;"></div>
                                                </div>
                                            </div>
                                            <div style="margin-top:6px;padding:10px 12px;background:#fff8e1;border-radius:8px;border-left:3px solid var(--extreme);">
                                                <div style="font-size:10px;font-weight:800;color:var(--extreme);margin-bottom:2px;">⚠ Alerta ejecutiva</div>
                                                <div style="font-size:10.5px;color:var(--muted);font-weight:600;line-height:1.5;">2 riesgos extremos con control <strong>Inaceptable (0 pts)</strong>: RSCI-26 y RSCI-36. Requieren plan de acción correctiva inmediata.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Resumen por proceso -->
                                    <div class="card" style="margin-bottom:0;padding:20px 22px;">
                                        <div class="card-title" style="font-size:13px;"><i class="ti ti-building" style="color:var(--blue);"></i> Riesgos por dirección</div>
                                        <div style="display:flex;flex-direction:column;gap:7px;margin-top:4px;">
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. Financiero y Contable</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:100%;height:100%;background:var(--blue);border-radius:4px;opacity:.8;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--blue);">15</div>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. Comercial</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:80%;height:100%;background:var(--extreme);border-radius:4px;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--extreme);">12</div>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. TI y Sostenibilidad</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:60%;height:100%;background:var(--high);border-radius:4px;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--high);">9</div>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. Riesgo y Cumplimiento</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:53%;height:100%;background:var(--blue);border-radius:4px;opacity:.7;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--muted);">8</div>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. Gestión Humana</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:40%;height:100%;background:var(--blue);border-radius:4px;opacity:.6;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--muted);">6</div>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. Jurídica</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:26%;height:100%;background:var(--blue);border-radius:4px;opacity:.5;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--muted);">4</div>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="font-size:10.5px;color:var(--muted);width:170px;flex-shrink:0;font-weight:600;">Dir. Otras Líneas de Negocio</div>
                                                <div style="flex:1;height:7px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                                                    <div style="width:20%;height:100%;background:var(--blue);border-radius:4px;opacity:.4;"></div>
                                                </div>
                                                <div style="font-size:10px;font-weight:800;min-width:22px;text-align:right;color:var(--muted);">3</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- FILA INFERIOR: Estado de controles + Riesgo más crítico -->
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:6px;">

                                    <!-- Estado global de controles -->
                                    <div class="card" style="margin-bottom:0;padding:20px 22px;">
                                        <div class="card-title" style="font-size:13px;"><i class="ti ti-shield" style="color:var(--blue);"></i> Estado global de controles</div>
                                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:4px;">
                                            <div style="background:#E8F5E9;border-radius:8px;padding:12px 14px;border-left:3px solid #27AE60;">
                                                <div style="font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#1B5E20;font-weight:800;margin-bottom:4px;">Óptimos ≥80</div>
                                                <div style="font-size:26px;font-weight:800;color:#1B5E20;line-height:1;">18</div>
                                                <div style="font-size:10px;color:#2E7D32;margin-top:2px;">31.6% del total</div>
                                            </div>
                                            <div style="background:#E3F2FD;border-radius:8px;padding:12px 14px;border-left:3px solid var(--blue);">
                                                <div style="font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:var(--blue-dark);font-weight:800;margin-bottom:4px;">Buenos 50–79</div>
                                                <div style="font-size:26px;font-weight:800;color:var(--blue);line-height:1;">17</div>
                                                <div style="font-size:10px;color:var(--blue);margin-top:2px;">29.8% del total</div>
                                            </div>
                                            <div style="background:#FFF8E1;border-radius:8px;padding:12px 14px;border-left:3px solid var(--high);">
                                                <div style="font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#E65100;font-weight:800;margin-bottom:4px;">Débiles 25–49</div>
                                                <div style="font-size:26px;font-weight:800;color:var(--high);line-height:1;">5</div>
                                                <div style="font-size:10px;color:var(--high);margin-top:2px;">8.8% del total</div>
                                            </div>
                                            <div style="background:#FFEBEE;border-radius:8px;padding:12px 14px;border-left:3px solid var(--extreme);">
                                                <div style="font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#B71C1C;font-weight:800;margin-bottom:4px;">Inaceptables 0–24</div>
                                                <div style="font-size:26px;font-weight:800;color:var(--extreme);line-height:1;">17</div>
                                                <div style="font-size:10px;color:var(--extreme);margin-top:2px;">29.8% del total</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Riesgo más crítico + marco normativo -->
                                    <div class="card" style="margin-bottom:0;padding:20px 22px;">
                                        <div class="card-title" style="font-size:13px;"><i class="ti ti-flame" style="color:var(--extreme);"></i> Riesgo de mayor score — RSCI-35</div>
                                        <div style="background:#FFEBEE;border-radius:8px;padding:12px 14px;margin-bottom:12px;border-left:3px solid var(--extreme);">
                                            <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:3px;">⚠ Score inherente 20/25 — Zona Extrema</div>
                                            <div style="font-size:12px;font-weight:600;color:var(--text);margin-bottom:4px;">Riesgo de mercado en cierres de negociaciones · Dir. Comercial</div>
                                            <div style="font-size:10.5px;color:var(--muted);font-weight:600;line-height:1.5;">Prob. <strong>5 (Casi cierto)</strong> · Impacto 4 (Mayor) · Control actual: <strong style="color:var(--high);">Bueno (50)</strong> — insuficiente para nivel extremo.</div>
                                        </div>
                                        <div class="card-title" style="font-size:12px;margin-bottom:10px;padding-bottom:8px;"><i class="ti ti-book" style="color:var(--muted);"></i> Marco normativo aplicable</div>
                                        <div style="display:flex;flex-direction:column;gap:6px;">
                                            <div style="display:flex;align-items:center;gap:8px;font-size:10.5px;color:var(--muted);font-weight:600;">
                                                <span style="width:6px;height:6px;border-radius:50%;background:var(--blue);flex-shrink:0;"></span>Circular Externa 100-000016 · Sagrilaft
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;font-size:10.5px;color:var(--muted);font-weight:600;">
                                                <span style="width:6px;height:6px;border-radius:50%;background:var(--blue);flex-shrink:0;"></span>COSO ERM · Marco Integrado 2013
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;font-size:10.5px;color:var(--muted);font-weight:600;">
                                                <span style="width:6px;height:6px;border-radius:50%;background:var(--blue);flex-shrink:0;"></span>Circular Externa 100-000002 · Sostenibilidad ASG
                                            </div>
                                            <div style="display:flex;align-items:center;gap:8px;font-size:10.5px;color:var(--muted);font-weight:600;">
                                                <span style="width:6px;height:6px;border-radius:50%;background:var(--eg-teal);flex-shrink:0;"></span>Análisis LA/FT · Sector Minero · Enlace Global
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- S1: RIESGOS Y PROBABILIDADES -->
                            <div class="section" id="s1">
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-chart-bar"></i> Riesgos y probabilidades · Agosto 2025</div>
                                    <div class="kpi-grid" style="margin-bottom:18px;">
                                        <div class="kpi">
                                            <div class="kpi-label">Prob. máxima</div>
                                            <div class="kpi-val extreme">5</div>
                                            <div class="kpi-sub">Casi cierto (RSCI-35)</div>
                                        </div>
                                        <div class="kpi">
                                            <div class="kpi-label">Prob. promedio SCI</div>
                                            <div class="kpi-val">2.4</div>
                                            <div class="kpi-sub">Rara Vez / Posible</div>
                                        </div>
                                        <div class="kpi">
                                            <div class="kpi-label">Riesgos prob. alta (4–5)</div>
                                            <div class="kpi-val high">10</div>
                                            <div class="kpi-sub">17.5% del total</div>
                                        </div>
                                    </div>
                                    <div class="chart-wrap"><canvas id="chartProb" role="img" aria-label="Riesgos por proceso"></canvas></div>
                                </div>
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-list"></i> Distribución por proceso</div>
                                    <table class="risk-table">
                                        <thead>
                                            <tr>
                                                <th>Proceso</th>
                                                <th>Código</th>
                                                <th># Riesgos</th>
                                                <th>Prob. máx.</th>
                                                <th>Factores principales</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Dirección de Riesgo y Cumplimiento</td>
                                                <td>DRC.001</td>
                                                <td>8</td>
                                                <td>3</td>
                                                <td>Operacional / Cumplimiento</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección Jurídica</td>
                                                <td>DJUR.002</td>
                                                <td>4</td>
                                                <td>3</td>
                                                <td>Cumplimiento / Operacional</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección Gestión Humana</td>
                                                <td>GH.003</td>
                                                <td>6</td>
                                                <td>4</td>
                                                <td>Operacional</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección Financiero y Contable</td>
                                                <td>DFC.004</td>
                                                <td>15</td>
                                                <td>3</td>
                                                <td>Operacional / Financiero / Cumplimiento</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección Comercial</td>
                                                <td>CRL.005</td>
                                                <td>12</td>
                                                <td><span class="badge badge-extreme">5</span></td>
                                                <td>Operacional / Financiero / Cumplimiento</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección TI y Sostenibilidad</td>
                                                <td>ASG.006</td>
                                                <td>9</td>
                                                <td>4</td>
                                                <td>Seguridad de la Información</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección Otras Líneas de Negocio</td>
                                                <td>DOLN.007</td>
                                                <td>3</td>
                                                <td>2</td>
                                                <td>Operacional</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- S2: DESCRIPCIÓN -->
                            <div class="section" id="s2">
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-file-description"></i> Descripción de riesgos · Agosto 2025</div>
                                    <select class="pf-select" id="descFilter" onchange="filterDesc()">
                                        <option value="all">— Todos los procesos —</option>
                                        <option value="DRC">DRC.001 · Dirección de Riesgo y Cumplimiento</option>
                                        <option value="JUR">DJUR.002 · Dirección Jurídica</option>
                                        <option value="GH">GH.003 · Dirección Gestión Humana</option>
                                        <option value="DFC">DFC.004 · Dirección Financiero y Contable</option>
                                        <option value="CRL">CRL.005 · Dirección Comercial</option>
                                        <option value="ASG">ASG.006 · Dirección TI y Sostenibilidad</option>
                                        <option value="DOLN">DOLN.007 · Dirección Otras Líneas de Negocio</option>
                                    </select>
                                    <div id="desc-container"></div>
                                </div>
                            </div>

                            <!-- S3: MATRIZ -->
                            <div class="section" id="s3">
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-table"></i> Mapa de riesgo — probabilidad × impacto</div>
                                    <div class="matrix-grid">
                                        <div></div>
                                        <div class="mg-head">1 Insignif.</div>
                                        <div class="mg-head">2 Menor</div>
                                        <div class="mg-head">3 Moderada</div>
                                        <div class="mg-head">4 Mayor</div>
                                        <div class="mg-head">5 Catastróf.</div>
                                        <div class="mg-ylabel">5 · Casi cierto</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-cell mg-extreme">Extremo</div>
                                        <div class="mg-cell mg-extreme">Extremo</div>
                                        <div class="mg-cell mg-extreme">Extremo</div>
                                        <div class="mg-ylabel">4 · Probable</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-cell mg-extreme">Extremo</div>
                                        <div class="mg-cell mg-extreme">Extremo</div>
                                        <div class="mg-ylabel">3 · Posible</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-cell mg-extreme">Extremo</div>
                                        <div class="mg-ylabel">2 · Rara vez</div>
                                        <div class="mg-cell mg-vlow">Bajo</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-cell mg-high">Alto</div>
                                        <div class="mg-ylabel">1 · Improbable</div>
                                        <div class="mg-cell mg-vlow">Muy bajo</div>
                                        <div class="mg-cell mg-vlow">Bajo</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                        <div class="mg-cell mg-moderate">Moderado</div>
                                    </div>
                                    <div class="legend-row">
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#C0392B"></div>Extremo (13–25)
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#E67E22"></div>Alto (6–12)
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#F1C40F"></div>Moderado (2–5)
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#27AE60"></div>Bajo / Muy bajo (0–1)
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-alert-triangle" style="color:#C0392B"></i> Riesgos con valoración inherente extrema (score 13–25)</div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-1 · DRC.001 · Dirección de Riesgo y Cumplimiento</div>
                                        <div class="critical-desc">Vinculación de contrapartes relacionados con actividades LAFT.</div>
                                        <div class="critical-meta">Prob. 3 (Posible) · Impacto 5 (Catastrófico) · Score inherente: <strong>15 — Extremo</strong> · Control: <span class="badge badge-optimal">Óptimo (100)</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-25 · DFC.004 · Dirección Financiero y Contable</div>
                                        <div class="critical-desc">Incumplimiento en presentación y pago de obligaciones tributarias.</div>
                                        <div class="critical-meta">Prob. 3 (Posible) · Impacto 5 (Catastrófico) · Score: <strong>15 — Extremo</strong> · Control: <span class="badge badge-optimal">Óptimo (85)</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-26 · DFC.004 · Dirección Financiero y Contable</div>
                                        <div class="critical-desc">Falta de planeación financiera.</div>
                                        <div class="critical-meta">Prob. 3 (Posible) · Impacto 5 (Catastrófico) · Score: <strong>15 — Extremo</strong> · Control: <span class="badge badge-inacept">Inaceptable (0) ⚠</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-31 · DFC.004 · Dirección Financiero y Contable</div>
                                        <div class="critical-desc">Operaciones no autorizadas.</div>
                                        <div class="critical-meta">Prob. 3 (Posible) · Impacto 5 (Catastrófico) · Score: <strong>15 — Extremo</strong> · Control: <span class="badge badge-good">Bueno (55)</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-35 · CRL.005 · Dirección Comercial</div>
                                        <div class="critical-desc">Riesgo de mercado (en cierres de negociaciones).</div>
                                        <div class="critical-meta">Prob. <strong>5 (Casi cierto)</strong> · Impacto 4 (Mayor) · Score: <strong>20 — Extremo ★ MAYOR SCORE</strong> · Control: <span class="badge badge-good">Bueno (50)</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-36 · CRL.005 · Dirección Comercial</div>
                                        <div class="critical-desc">Restricción de coberturas financieras.</div>
                                        <div class="critical-meta">Prob. 4 (Probable) · Impacto 4 (Mayor) · Score: <strong>16 — Extremo</strong> · Control: <span class="badge badge-inacept">Inaceptable (0) ⚠</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-45 · CRL.005 · Dirección Comercial</div>
                                        <div class="critical-desc">Vulnerabilidad en la seguridad del sitio donde funciona el laboratorio.</div>
                                        <div class="critical-meta">Prob. 3 (Posible) · Impacto 5 (Catastrófico) · Score: <strong>15 — Extremo</strong> · Control: <span class="badge badge-good">Bueno (55)</span></div>
                                    </div>
                                    <div class="critical-card">
                                        <div class="critical-code">RSCI-48 · ASG.006 · Dirección TI y Sostenibilidad</div>
                                        <div class="critical-desc">Ataque cibernético.</div>
                                        <div class="critical-meta">Prob. 3 (Posible) · Impacto 5 (Catastrófico) · Score: <strong>15 — Extremo</strong> · Control: <span class="badge badge-good">Bueno (55)</span></div>
                                    </div>
                                </div>
                            </div>

                            <!-- S4: MAPA TÉRMICO -->
                            <div class="section" id="s4">
                                <div class="card" style="border-left:4px solid #C0392B;">
                                    <div class="card-title"><i class="ti ti-flame" style="color:#C0392B"></i> Mapa térmico SCI · Alta relevancia</div>
                                    <p style="font-size:12px;color:var(--muted);margin-bottom:16px;line-height:1.6;">El mapa posiciona cada riesgo en el cuadrante Probabilidad (eje Y) × Impacto (eje X). Zona roja (Extrema): score ≥ 13, requiere acción ejecutiva inmediata. Zona naranja (Alta): gestión priorizada por dueño del proceso bajo supervisión de Gerencia y Revisoría Fiscal.</p>
                                    <div class="thermal-tabs" id="thermal-tabs">
                                        <button class="thermal-tab on" onclick="showThermal('all',this)">Todos</button>
                                        <button class="thermal-tab" onclick="showThermal('DRC',this)">DRC.001</button>
                                        <button class="thermal-tab" onclick="showThermal('JUR',this)">Jurídico</button>
                                        <button class="thermal-tab" onclick="showThermal('GH',this)">G. Humana</button>
                                        <button class="thermal-tab" onclick="showThermal('DFC',this)">Financiero</button>
                                        <button class="thermal-tab" onclick="showThermal('CRL',this)">Comercial</button>
                                        <button class="thermal-tab" onclick="showThermal('ASG',this)">TI / Sostenib.</button>
                                        <button class="thermal-tab" onclick="showThermal('DOLN',this)">Otras Líneas</button>
                                    </div>
                                    <div style="display:grid;grid-template-columns:90px 1fr;gap:8px;align-items:end;margin-bottom:4px;">
                                        <div></div>
                                        <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:4px;text-align:center;font-size:10px;color:var(--muted);">
                                            <div>1 Insignif.</div>
                                            <div>2 Menor</div>
                                            <div>3 Moderada</div>
                                            <div>4 Mayor</div>
                                            <div>5 Catastróf.</div>
                                        </div>
                                    </div>
                                    <div style="display:grid;grid-template-columns:90px 1fr;gap:8px;">
                                        <div style="display:flex;flex-direction:column-reverse;gap:4px;">
                                            <div style="height:64px;display:flex;align-items:center;justify-content:flex-end;font-size:9px;color:var(--muted);text-align:right;padding-right:4px;">1 · Improbable</div>
                                            <div style="height:64px;display:flex;align-items:center;justify-content:flex-end;font-size:9px;color:var(--muted);text-align:right;padding-right:4px;">2 · Rara vez</div>
                                            <div style="height:64px;display:flex;align-items:center;justify-content:flex-end;font-size:9px;color:var(--muted);text-align:right;padding-right:4px;">3 · Posible</div>
                                            <div style="height:64px;display:flex;align-items:center;justify-content:flex-end;font-size:9px;color:var(--muted);text-align:right;padding-right:4px;">4 · Probable</div>
                                            <div style="height:64px;display:flex;align-items:center;justify-content:flex-end;font-size:9px;color:var(--muted);text-align:right;padding-right:4px;">5 · Casi cierto</div>
                                        </div>
                                        <div id="thermal-map"></div>
                                    </div>
                                    <div class="legend-row" style="margin-top:12px;">
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#C0392B"></div>Extremo
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#E67E22"></div>Alto
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#F1C40F"></div>Moderado
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot" style="background:#27AE60"></div>Bajo / Muy bajo
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-analyze"></i> Análisis ejecutivo — zona extrema</div>
                                    <p style="font-size:12px;color:var(--muted);margin-bottom:12px;line-height:1.6;">Los 9 riesgos en zona <strong>Extrema</strong> representan el 15.8% del total. Combinan alta probabilidad de ocurrencia con impacto catastrófico o mayor. La estrategia de gestión obligatoria es: <em>Evitar, prevenir, controlar y mitigar al máximo</em>.</p>
                                    <div class="alert-box alert-extreme">
                                        <div class="alert-title">⚠ Alerta crítica — RSCI-35 · Dirección Comercial</div>
                                        <div class="alert-body">El riesgo de mercado (RSCI-35) es el único con probabilidad 5 (Casi cierto) en toda la matriz. Score inherente: 20/25. El control vigente califica como <strong>Bueno (50)</strong>, insuficiente para un riesgo de esta magnitud. Se recomienda escalar a nivel de Gerencia General con plan de acción mensual.</div>
                                    </div>
                                    <div class="alert-box alert-high">
                                        <div class="alert-title">⚠ Control inaceptable en zona extrema — RSCI-26 y RSCI-36</div>
                                        <div class="alert-body">Dos riesgos extremos —Falta de planeación financiera (RSCI-26) y Restricción de coberturas (RSCI-36)— tienen control calificado como <strong>Inaceptable (0 puntos)</strong>. No existe documentación, ni aplicación, ni efectividad comprobada. Requieren plan de acción correctiva inmediata con responsables designados.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- S5: VALORACIÓN CONTROLES -->
                            <div class="section" id="s5">
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-shield"></i> Valoración de controles · Escala SCI</div>
                                    <div class="kpi-grid">
                                        <div class="kpi">
                                            <div class="kpi-label">Controles óptimos</div>
                                            <div class="kpi-val" style="color:#1B5E20;">18</div>
                                            <div class="kpi-sub">Score ≥ 80</div>
                                        </div>
                                        <div class="kpi">
                                            <div class="kpi-label">Controles buenos</div>
                                            <div class="kpi-val" style="color:#0D47A1;">17</div>
                                            <div class="kpi-sub">Score 50–79</div>
                                        </div>
                                        <div class="kpi">
                                            <div class="kpi-label">Controles débiles</div>
                                            <div class="kpi-val high">5</div>
                                            <div class="kpi-sub">Score 25–49</div>
                                        </div>
                                        <div class="kpi">
                                            <div class="kpi-label">Controles inaceptables</div>
                                            <div class="kpi-val extreme">17</div>
                                            <div class="kpi-sub">Score 0–24</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-adjustments"></i> Tres dimensiones de evaluación</div>
                                    <div class="ctrl-bar-wrap">
                                        <div class="ctrl-bar-label"><span>Formalidad (documentación / normalización)</span><span style="font-weight:700;color:var(--blue);">Peso: 15 pts</span></div>
                                        <div class="ctrl-bar-sub">0 = Sin documentar · 7 = Documentado · 10 = Doc. y aprobado · 15 = Doc., aprobado y divulgado</div>
                                        <div class="ctrl-bar">
                                            <div class="ctrl-bar-fill" style="width:15%;background:#0F52A0;"></div>
                                        </div>
                                    </div>
                                    <div class="ctrl-bar-wrap">
                                        <div class="ctrl-bar-label"><span>Aplicación (frecuencia de ejecución)</span><span style="font-weight:700;color:var(--high);">Peso: 20 pts</span></div>
                                        <div class="ctrl-bar-sub">0 = Nunca · 5 = A discreción e incompleto · 10 = A discreción, debidamente · 15 = Siempre incompleto · 20 = Siempre y debidamente</div>
                                        <div class="ctrl-bar">
                                            <div class="ctrl-bar-fill" style="width:20%;background:#E67E22;"></div>
                                        </div>
                                    </div>
                                    <div class="ctrl-bar-wrap">
                                        <div class="ctrl-bar-label"><span>Efectividad (eficiencia + eficacia)</span><span style="font-weight:700;color:#27AE60;">Peso: 65 pts</span></div>
                                        <div class="ctrl-bar-sub">0 = No efectivo · 15 = Solo eficiente · 35 = Solo eficaz · 65 = Efectivo (eficiente + eficaz)</div>
                                        <div class="ctrl-bar">
                                            <div class="ctrl-bar-fill" style="width:65%;background:#27AE60;"></div>
                                        </div>
                                    </div>
                                    <div style="background:#f0f4fa;border-radius:8px;padding:12px 14px;font-size:11px;color:var(--muted);line-height:1.6;margin-top:8px;">
                                        <strong>Principios clave:</strong> Los controles preventivos reducen probabilidad. Los detectivos reducen probabilidad e impacto. Los correctivos sólo reducen impacto. Orden de preferencia SCI: Preventivo → Detectivo → Correctivo.
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-clock"></i> Periodicidad de revisión por tipo de control</div>
                                    <table class="risk-table">
                                        <thead>
                                            <tr>
                                                <th>Tipo de control</th>
                                                <th>Periodicidad SCI</th>
                                                <th>Efecto sobre el riesgo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge badge-good">Preventivo</span></td>
                                                <td>Cada 3 meses</td>
                                                <td>Reduce probabilidad</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge badge-optimal">Detectivo</span></td>
                                                <td>Semanal</td>
                                                <td>Reduce probabilidad e impacto</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge badge-weak">Correctivo</span></td>
                                                <td>Mensual</td>
                                                <td>Reduce impacto</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- S6: CRITERIOS -->
                            <div class="section" id="s6">
                                <div class="card">
                                    <div class="card-title"><i class="ti ti-book"></i> Criterios de valoración — probabilidad e impacto</div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text);margin-bottom:10px;">Escala de probabilidad de frecuencia</div>
                                    <div class="criteria-box">
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#27AE60;">1</div>
                                            <div>
                                                <div class="criteria-text">Improbable</div>
                                                <div class="criteria-sub">Difícil que ocurra. Se ha presentado alguna vez en los últimos 5 años. El evento ocurre en el 1% de las operaciones al año.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#2ECC71;">2</div>
                                            <div>
                                                <div class="criteria-text">Rara vez</div>
                                                <div class="criteria-sub">Puede ocurrir en circunstancias excepcionales. Se ha presentado alguna vez en los últimos 3 años. Entre el 2% y el 5% de las operaciones.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#F1C40F;">3</div>
                                            <div>
                                                <div class="criteria-text">Posible</div>
                                                <div class="criteria-sub">Podría ocurrir en algún momento. Se ha presentado en el último año. Entre el 6% y el 15% de las operaciones.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#E67E22;">4</div>
                                            <div>
                                                <div class="criteria-text">Probable</div>
                                                <div class="criteria-sub">Probablemente ocurrirá. Se presenta con frecuencia (ej. 5 veces al año). Entre el 16% y el 25% de las operaciones.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#C0392B;">5</div>
                                            <div>
                                                <div class="criteria-text">Casi cierto</div>
                                                <div class="criteria-sub">Se espera que ocurra en la mayoría de circunstancias. Ocurre con mucha periodicidad (ej. cada mes en promedio). Más del 25% de las operaciones.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text);margin:16px 0 10px;">Escala de impacto</div>
                                    <div class="criteria-box">
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#27AE60;">1</div>
                                            <div>
                                                <div class="criteria-text">Insignificante</div>
                                                <div class="criteria-sub">No genera perjuicios.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#2ECC71;">2</div>
                                            <div>
                                                <div class="criteria-text">Menor</div>
                                                <div class="criteria-sub">Pocos perjuicios que se controlan local e inmediatamente.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#F1C40F;">3</div>
                                            <div>
                                                <div class="criteria-text">Moderada</div>
                                                <div class="criteria-sub">Perjuicios controlados localmente y/o con asistencia externa; pueden generar riesgos asociados.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#E67E22;">4</div>
                                            <div>
                                                <div class="criteria-text">Mayor</div>
                                                <div class="criteria-sub">Perjuicios extensivos con pérdida de capacidad productiva; generan riesgos asociados importantes.</div>
                                            </div>
                                        </div>
                                        <div class="criteria-row">
                                            <div class="criteria-num" style="color:#C0392B;">5</div>
                                            <div>
                                                <div class="criteria-text">Catastrófica</div>
                                                <div class="criteria-sub">Perjuicios que generan pérdidas financieras, legales y de reputación importantes.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text);margin:16px 0 10px;">Concepto de riesgo inherente según score</div>
                                    <table class="risk-table">
                                        <thead>
                                            <tr>
                                                <th>Score</th>
                                                <th>Zona</th>
                                                <th>Concepto de gestión</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>0–1</td>
                                                <td><span class="badge badge-low">Muy bajo</span></td>
                                                <td>Asumir riesgo</td>
                                            </tr>
                                            <tr>
                                                <td>2–5</td>
                                                <td><span class="badge badge-low">Moderado bajo</span></td>
                                                <td>Prevenir y mitigar riesgo</td>
                                            </tr>
                                            <tr>
                                                <td>6–12</td>
                                                <td><span class="badge badge-high">Alto</span></td>
                                                <td>Prevenir, mitigar, controlar, compartir y transferir</td>
                                            </tr>
                                            <tr>
                                                <td>13–25</td>
                                                <td><span class="badge badge-extreme">Extremo</span></td>
                                                <td>Evitar, prevenir, controlar y mitigar al máximo</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="section" id="sMin">

                                <!-- HERO MINERÍA -->
                                <div class="min-hero">
                                    <div class="min-hero-title">⛏ Análisis de Riesgo LA/FT — Sector Minero Exportador · Colombia</div>
                                    <div class="min-hero-sub">Blindaje Forense · Enlace Global · GAFILAT 2025–2026 · Circular Externa 100-000016<br>Fuentes: UNODC · ANM · UIAF · NYT / US Mint · Fiscalía · OCDE · LBMA</div>
                                    <span class="min-badge">⚠ Riesgo Crítico 9.5 / 10</span>
                                    <span class="min-badge">GAFILAT 2025–2026</span>
                                    <span class="min-badge">SAGRILAFT 3.0</span>
                                    <span class="min-badge">OCDE Minerales</span>
                                    <span class="min-badge">RUCOM ANM 2026</span>
                                </div>

                                <!-- KPIs minería -->
                                <div class="min-kpi-grid">
                                    <div class="min-kpi">
                                        <div class="min-kpi-label">Riesgo inherente</div>
                                        <div class="min-kpi-val crit">9.5/10</div>
                                        <div class="min-kpi-sub">Más crítico del sistema</div>
                                    </div>
                                    <div class="min-kpi">
                                        <div class="min-kpi-label">Export. oro feb 2026</div>
                                        <div class="min-kpi-val crit">US$771.8M</div>
                                        <div class="min-kpi-sub">+140.8% interanual</div>
                                    </div>
                                    <div class="min-kpi">
                                        <div class="min-kpi-label">Sin trazabilidad real</div>
                                        <div class="min-kpi-val crit">+80%</div>
                                        <div class="min-kpi-sub">Exportaciones oro · ANM 2026</div>
                                    </div>
                                    <div class="min-kpi">
                                        <div class="min-kpi-label">Explotación ilegal</div>
                                        <div class="min-kpi-val crit">72%</div>
                                        <div class="min-kpi-sub">Zonas estables · UNODC</div>
                                    </div>
                                    <div class="min-kpi">
                                        <div class="min-kpi-label">Lavado estimado</div>
                                        <div class="min-kpi-val crit">~$10 bill.</div>
                                        <div class="min-kpi-sub">COP/año · Contraloría</div>
                                    </div>
                                    <div class="min-kpi">
                                        <div class="min-kpi-label">Precio oro 2025</div>
                                        <div class="min-kpi-val teal">~US$3.500</div>
                                        <div class="min-kpi-sub">Por onza · +30% en 2025</div>
                                    </div>
                                </div>

                                <!-- Botón Matriz de Riesgo -->
                                <div onclick="openMinModal()" style="background:linear-gradient(135deg,var(--eg-teal-l),var(--eg-green-l));border:2px solid var(--eg-teal-m);border-radius:var(--radius);padding:13px 18px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;transition:all .2s;" onmouseover="this.style.borderColor='var(--eg-teal)';this.style.transform='translateY(-1px)'" onmouseout="this.style.borderColor='var(--eg-teal-m)';this.style.transform='translateY(0)'">
                                    <div style="display:flex;align-items:center;gap:12px;"><span style="font-size:22px;">🗺️</span>
                                        <div>
                                            <div style="font-size:13px;font-weight:800;color:var(--eg-teal-d);">Ver Matriz de Riesgo — Sector Minero Exportador</div>
                                            <div style="font-size:10.5px;color:var(--muted);margin-top:1px;">Mapa de calor: zonas de conflicto · trazabilidad del oro · TBML exportaciones · Plan de acción</div>
                                        </div>
                                    </div>
                                    <span style="font-size:18px;color:var(--eg-teal);font-weight:900;">▶</span>
                                </div>

                                <!-- SEP: Exposición -->
                                <div class="sep-min sep-orange-v">
                                    <div class="sep-min-bar"></div>
                                    <div class="sep-min-content"><span>📊</span>Exposición por Categoría de Riesgo y Perfil Inherente</div>
                                </div>

                                <div class="two-col-min">
                                    <div class="min-card">
                                        <div class="min-card-title"><span class="ct-dot" style="background:var(--red)"></span>Exposición por categoría de riesgo</div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Minería ilegal / grupos armados</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:96%;background:var(--red);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--red);">96%</div>
                                        </div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Lavado oro en cadena formal</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:93%;background:var(--red);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--red);">93%</div>
                                        </div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Subfacturación exportaciones</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:88%;background:var(--red);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--red);">88%</div>
                                        </div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Comercializadoras sin RUCOM</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:82%;background:var(--eg-orange);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--eg-orange);">82%</div>
                                        </div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Corrupción en regalías</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:78%;background:var(--eg-orange);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--eg-orange);">78%</div>
                                        </div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Convergencia coca-minería</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:72%;background:var(--eg-orange);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--eg-orange);">72%</div>
                                        </div>
                                        <div class="bar-row-min">
                                            <div class="bar-lbl-min">Trata de personas en minas</div>
                                            <div class="bar-track-min">
                                                <div class="bar-fill-min" style="width:60%;background:var(--eg-teal);"></div>
                                            </div>
                                            <div class="bar-val-min" style="color:var(--eg-teal-d);">60%</div>
                                        </div>
                                        <div style="display:flex;gap:10px;margin-top:10px;flex-wrap:wrap;">
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:var(--red);"></div>Crítico
                                            </div>
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:var(--eg-orange);"></div>Alto
                                            </div>
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:var(--eg-teal);"></div>Medio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="min-card">
                                        <div class="min-card-title"><span class="ct-dot" style="background:var(--red)"></span>Indicadores clave del sector</div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Exportaciones oro ene-feb 2025</span><span class="stat-val-min" style="color:var(--eg-teal-d);">US$649M (+31.6%)</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Exportaciones oro feb 2026</span><span class="stat-val-min" style="color:var(--red);">US$771.8M (+140.8%)</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Producción estimada 2023 (ANM)</span><span class="stat-val-min">~35 toneladas</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">% explotación zonas sin Estado</span><span class="stat-val-min" style="color:var(--red);">+72% ilegal</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Lavado estimado por minería ilegal</span><span class="stat-val-min" style="color:var(--red);">~$10 billones COP/año</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Departamentos de mayor riesgo</span><span class="stat-val-min" style="color:var(--red);">Chocó · Antioquia · Bolívar</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Grupos armados activos</span><span class="stat-val-min">ELN · AGC · Disid. FARC</span></div>
                                        <div class="stat-row-min"><span style="color:var(--muted);">Precio oro 2025</span><span class="stat-val-min" style="color:var(--eg-orange);">~US$3.500/oz (+30%)</span></div>
                                    </div>
                                </div>

                                <!-- SEP: Hallazgos -->
                                <div class="sep-min sep-red-v">
                                    <div class="sep-min-bar"></div>
                                    <div class="sep-min-content"><span>🔍</span>Hallazgos Críticos del Sector</div>
                                </div>

                                <div class="alert-min am-red">
                                    <div class="am-title">H-1 · +80% exportaciones de oro sin trazabilidad verificable — ANM 2026</div>
                                    <div class="am-body">La ANM confirmó que más del 80% de las exportaciones de oro colombiano carecen de trazabilidad real. Colombia exportó US$649M en oro ene-feb 2025 (+31.6%). Oro ilegal colombiano fue detectado en la cadena de suministro de la US Mint (NYT / Departamento del Tesoro, abril 2026). El Tesoro de EE.UU. inició revisión de estándares de abastecimiento.</div>
                                </div>
                                <div class="alert-min am-red">
                                    <div class="am-title">H-2 · 72% zonas estables de minería son explotadas ilegalmente — UNODC 2023</div>
                                    <div class="am-body">El 85% de la explotación de oro aluvial se concentra en Chocó (40%), Antioquia (37%) y Bolívar (8%). En el Sur de Bolívar, el 70% del oro aluvial es ilícito. ELN, AGC (Clan del Golfo) y disidencias FARC imponen tributación de facto sobre cada gramo extraído.</div>
                                </div>
                                <div class="alert-min am-amber">
                                    <div class="am-title">H-3 · Convergencia coca–minería ilegal en el 44% de territorios EVOA — UNODC</div>
                                    <div class="am-body">En casi la mitad de los territorios con Explotación de Yacimientos de Oro Aluvial (EVOA) también hay cultivos de coca. La explotación ilegal asciende al 87% en departamentos de Antioquia, Nariño y Cauca. Más del 52% ocurre en territorios de protección especial o resguardos indígenas.</div>
                                </div>

                                <!-- SEP: Inteligencia -->
                                <div class="sep-min sep-dark-v">
                                    <div class="sep-min-bar"></div>
                                    <div class="sep-min-content"><span>📰</span>Inteligencia de Alertas — Sector Minero / Exportación</div>
                                </div>

                                <div class="news-grid-min">
                                    <div class="nc-min nc-red">
                                        <div class="nc-src-min"><span class="src-tag st-red">NYT / US Mint</span><span class="nc-date-min">Abr 2026</span></div>
                                        <div class="nc-title-min">Oro ilegal colombiano detectado en cadena de suministro de la Casa de Moneda de EE.UU.</div>
                                        <div class="nc-body-min">Investigación del New York Times revela que oro extraído en zonas controladas por grupos armados colombianos llega a la US Mint. El Departamento del Tesoro inicia revisión de estándares. Casi US$1.500M desde Colombia bajo escrutinio. La ANM lanza plataforma de trazabilidad en respuesta (mayo 2026).</div>
                                        <span class="nc-tag-min nct-r">Alerta internacional</span>
                                    </div>
                                    <div class="nc-min nc-red">
                                        <div class="nc-src-min"><span class="src-tag st-fatf">UNODC / GAFILAT</span><span class="nc-date-min">Dic 2023</span></div>
                                        <div class="nc-title-min">Minería ilegal: primera fuente de financiamiento de grupos armados, superando al narcotráfico en rentabilidad</div>
                                        <div class="nc-body-min">UNODC e Interpol documentan que la minería ilegal se consolida como la actividad ilícita más rentable de los grupos armados colombianos. El 72% de las zonas de explotación estable son ilegales. El 44% de territorios EVOA también tienen cultivos de coca.</div>
                                        <span class="nc-tag-min nct-r">Informe UNODC</span>
                                    </div>
                                    <div class="nc-min nc-amber">
                                        <div class="nc-src-min"><span class="src-tag st-news">Infobae / ANM</span><span class="nc-date-min">Abr 2026</span></div>
                                        <div class="nc-title-min">ANM lanza plataforma de trazabilidad de oro en tiempo real — respuesta al escándalo US Mint</div>
                                        <div class="nc-body-min">La Agencia Nacional de Minería anuncia sistema que integra RUCOM, Génesis y Control a la Producción. Alerta automática cuando un minero de subsistencia supere 420 gramos anuales. Las alcaldías deberán certificar que los sitios de explotación están libres de coacción de grupos armados.</div>
                                        <span class="nc-tag-min nct-a">Nuevo control 2026</span>
                                    </div>
                                    <div class="nc-min nc-red">
                                        <div class="nc-src-min"><span class="src-tag st-green">Ejército/Fiscalía</span><span class="nc-date-min">Dic 2025</span></div>
                                        <div class="nc-title-min">Ejército y Armada destruyen maquinaria de minería ilegal en Cauca y Bajo Cauca antioqueño</div>
                                        <div class="nc-body-min">Operativos conjuntos destruyen retroexcavadora y tres clasificadoras en Guapi (Cauca) vinculadas a grupos armados. Decreto 1035/2024 autoriza destrucción in situ de maquinaria amarilla ilegal. Operaciones simultáneas en Puerto Bélgica, Cáceres, Bajo Cauca antioqueño.</div>
                                        <span class="nc-tag-min nct-r">Operativo militar</span>
                                    </div>
                                </div>

                                <!-- SEP: Investigación de fraude -->
                                <div class="sep-min sep-green-v">
                                    <div class="sep-min-bar"></div>
                                    <div class="sep-min-content"><span>🔬</span>Investigación de Fraude Financiero — Sector Minero · Colombia 2016–2026</div>
                                </div>

                                <div class="min-card">
                                    <div class="fraud-resumen-min">
                                        <div class="fraud-resumen-title-min">Resumen Ejecutivo del Fraude Sectorial</div>
                                        <div class="fraud-resumen-body-min">El sector minero colombiano constituye el <strong>vector de lavado de activos más crítico del país</strong>, superando en impacto al narcotráfico en zonas de conflicto armado. La minería ilegal podría lavar anualmente hasta <strong>$10 billones COP</strong> (Contraloría / El Tiempo). Entre 2003 y 2011 se reportaron <strong>53 toneladas de exportaciones de oro por encima de la producción registrada</strong>. En 2026, el NYT reveló que oro colombiano ilegal llegó a la US Mint, desatando una crisis diplomática de trazabilidad. El <strong>ELN, las AGC y disidencias FARC</strong> imponen tributación de facto en las zonas de extracción, convirtiéndose en actores centrales del circuito financiero ilícito.</div>
                                    </div>

                                    <div class="min-card-title" style="margin-bottom:10px;"><span class="ct-dot" style="background:var(--eg-teal);"></span>Modalidades de Fraude — Análisis por Criticidad</div>
                                    <div style="overflow-x:auto;margin-bottom:16px;">
                                        <table class="fraud-table-min">
                                            <tr>
                                                <th>Modalidad</th>
                                                <th>Modus Operandi</th>
                                                <th>Tipo</th>
                                                <th>Criticidad</th>
                                                <th>Impacto Documentado</th>
                                            </tr>
                                            <tr>
                                                <td><strong>Mezcla de oro legal e ilegal</strong></td>
                                                <td style="font-size:10.5px;">Oro extraído ilegalmente en zonas de conflicto es mezclado con producción legal antes de la exportación. El oro funde y pierde trazabilidad de origen. Intermediarios emiten documentación RUCOM aparentemente válida para oro de origen ilícito</td>
                                                <td>Externo</td>
                                                <td><span class="crit-alto"><span class="crit-dot"></span>CRÍTICO</span></td>
                                                <td style="font-size:10.5px;">+80% exportaciones sin trazabilidad real · US Mint 2026</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tributación forzada grupos armados</strong></td>
                                                <td style="font-size:10.5px;">ELN, AGC y disidencias FARC cobran entre el 5% y 15% de cada gramo extraído como "vacuna". Las minas con título formal son operadas bajo control armado sin que el Estado lo detecte</td>
                                                <td>Externo</td>
                                                <td><span class="crit-alto"><span class="crit-dot"></span>CRÍTICO</span></td>
                                                <td style="font-size:10.5px;">Alias "Calarcá" controla reserva de $50.000M COP en oro</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Subfacturación en exportaciones</strong></td>
                                                <td style="font-size:10.5px;">Declaración de valor inferior al real en exportaciones. Diferencial se queda en cuentas en el exterior sin retornar al país. Entre 2003–2011 se exportaron 53 ton por encima de lo producido oficialmente</td>
                                                <td>Externo</td>
                                                <td><span class="crit-alto"><span class="crit-dot"></span>CRÍTICO</span></td>
                                                <td style="font-size:10.5px;">53 toneladas extra exportadas (2003-2011) — Contraloría</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Comercializadoras sin control</strong></td>
                                                <td style="font-size:10.5px;">Sociedades de Comercialización Internacional (C.I.) que compran oro a mineros de subsistencia sin verificar origen real. La mitad de la producción pasa por esta categoría, usada por organizaciones criminales para legalizar oro de fuente ilícita</td>
                                                <td>Externo + Interno</td>
                                                <td><span class="crit-alto"><span class="crit-dot"></span>CRÍTICO</span></td>
                                                <td style="font-size:10.5px;">+50% producción nacional vía minería subsistencia — UNODC</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Evasión de regalías y corrupción ANM</strong></td>
                                                <td style="font-size:10.5px;">Subregistro de producción real para pagar menos regalías. Pago de sobornos a funcionarios ANM para obtener licencias, reducir fiscalización. El 65% de unidades mineras no pagaba regalías (Contraloría)</td>
                                                <td>Interno + Externo</td>
                                                <td><span class="crit-medio"><span class="crit-dot"></span>ALTO</span></td>
                                                <td style="font-size:10.5px;">65% sin pago regalías · Drummond: ~$1 billón evasión</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Convergencia coca-minería (EVOA)</strong></td>
                                                <td style="font-size:10.5px;">Inversión de ganancias del narcotráfico en equipos de minería. En el 44% de territorios EVOA también hay coca. Los grupos criminales lavan dinero de la coca comprando maquinaria y financiando operaciones mineras</td>
                                                <td>Externo</td>
                                                <td><span class="crit-medio"><span class="crit-dot"></span>ALTO</span></td>
                                                <td style="font-size:10.5px;">87% explotación ilegal en zonas con coca — UNODC/Mongabay</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="min-card-title" style="margin-bottom:10px;"><span class="ct-dot" style="background:var(--eg-orange);"></span>Cronología de Casos Documentados 2016–2026</div>
                                    <div class="tl-wrap">
                                        <div class="tl-item">
                                            <div class="tl-year">2016–2019</div>
                                            <div class="tl-body"><strong>UIAF detecta 449 productos de inteligencia por $45 billones</strong> — Entre 2019 y diciembre 2021 la UIAF difundió 449 productos de inteligencia relacionados con lavado de activos, estimando $1.2 billones vinculados a delitos ambientales incluyendo minería ilegal. El Convenio UIAF-Ministerio de Minas formaliza el trabajo de inteligencia financiera en el sector.<div class="tl-src">Fuente: UIAF / Infolaft — Informe 2021</div>
                                            </div>
                                        </div>
                                        <div class="tl-item">
                                            <div class="tl-year yr-red">2018</div>
                                            <div class="tl-body"><strong>Captura alcalde de Nóvita–Chocó por minería ilegal</strong> — El alcalde Deyler Eduardo Camacho Mosquera es capturado por facilitar el ingreso de insumos a zonas de extracción ilegal en Chocó. La Fiscalía estima que la minería ilegal en ese departamento generó $3.4 billones de pesos.<div class="tl-src">Fuente: Fiscalía GN / Transparencia por Colombia 2018</div>
                                            </div>
                                        </div>
                                        <div class="tl-item">
                                            <div class="tl-year yr-red">2022</div>
                                            <div class="tl-body"><strong>Minería ilegal: primera fuente de financiamiento de grupos armados</strong> — Documentos de la Fiscalía analizados por OjoPúblico/NarcoFiles revelan que el ELN y los GAOR dominan la minería en Bolívar. El precio de la coca cayó un 30% en el Cauca mientras el oro subía, acelerando la transición de organizaciones criminales hacia el oro.<div class="tl-src">Fuente: OjoPúblico / El Espectador / NarcoFiles — dic 2023</div>
                                            </div>
                                        </div>
                                        <div class="tl-item">
                                            <div class="tl-year yr-red">2025</div>
                                            <div class="tl-body"><strong>Alias "Calarcá" controla reserva de oro de $50.000M COP</strong> — Informes de inteligencia militar revelan que el comandante disidente de las FARC "Calarcá" controla un alijo de oro valorado en 50.000 millones de pesos (≈USD 12M). El aumento del precio del oro (+30% en 2025) transformó reservas dormidas en poder líquido para financiar operaciones guerrilleras.<div class="tl-src">Fuente: FACT Coalition / Informes inteligencia militar — abr 2025</div>
                                            </div>
                                        </div>
                                        <div class="tl-item">
                                            <div class="tl-year yr-red">2026</div>
                                            <div class="tl-body"><strong>Escándalo US Mint — Oro ilegal colombiano en la Casa de Moneda de EE.UU.</strong> — The New York Times revela que oro extraído en zonas de control armado colombiano llegó a la cadena de suministro de la US Mint. Casi USD 1.500M bajo revisión. El Departamento del Tesoro confirma revisión de estándares. La ANM lanza plataforma RUCOM/Génesis de trazabilidad en tiempo real.<div class="tl-src">Fuente: NYT / Minería en Línea / Infobae / ANM — abr-may 2026</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="min-card-title" style="margin-bottom:10px;"><span class="ct-dot" style="background:var(--eg-green);"></span>Recomendaciones de Control Interno</div>
                                    <div class="ctrl-grid-min">
                                        <div class="ctrl-card-min cc-teal">
                                            <div class="cc-title">🔗 Verificación RUCOM + Trazabilidad ANM</div>
                                            <div class="cc-body">Toda comercializadora o C.I. de oro debe estar registrada activamente en el RUCOM y a partir de mayo 2026 en la nueva plataforma de trazabilidad ANM. Exigir código único de transacción por cada operación de compra. Si el minero supera 420g/año sin título minero = red flag inmediato.</div>
                                        </div>
                                        <div class="ctrl-card-min cc-red">
                                            <div class="cc-title">🗺️ Mapa de Zonas de Control Armado</div>
                                            <div class="cc-body">Rechazar oro proveniente de Chocó, Sur de Bolívar, Bajo Cauca, Nariño y Cauca sin certificación de que la mina está libre de coacción armada (exigida por ANM desde 2026). Cruzar municipio de origen contra índice GDELT de conflictividad.</div>
                                        </div>
                                        <div class="ctrl-card-min cc-orange">
                                            <div class="cc-title">📊 Validación de Precios vs London Bullion</div>
                                            <div class="cc-body">Cruzar precio declarado en exportación de oro contra London Bullion Market Association (LBMA) y precios spot del Banco de la República. Brecha &gt;5% sin justificación técnica = subfacturación TBML. Documentar trazabilidad desde mina hasta refinería.</div>
                                        </div>
                                        <div class="ctrl-card-min cc-green">
                                            <div class="cc-title">🌐 Debida Diligencia OCDE — Cadena de Suministro</div>
                                            <div class="cc-body">Implementar Guía de Debida Diligencia OCDE para Cadenas de Suministro Responsables de Minerales. Exigir certificación de refinerías internacionales (LBMA, DMCC). Para compradores institucionales: verificar que el exportador cumple estándares SAGRILAFT 3.0.</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEP: APD -->
                                <div class="sep-min sep-teal-v">
                                    <div class="sep-min-bar"></div>
                                    <div class="sep-min-content"><span>🛡️</span>Prueba de Auditoría — Prevención de Riesgos LA/FT · Sector Minero</div>
                                </div>

                                <div class="apd-wrap">
                                    <div class="apd-hdr">
                                        <div class="apd-hdr-left">
                                            <div class="apd-shield">⛏️</div>
                                            <div>
                                                <div class="apd-hdr-title">Prueba de Auditoría — Minería / Exportación · APD DIAN OD-COA-0106</div>
                                                <div class="apd-hdr-sub">Papel de Trabajo: Trazabilidad RUCOM · Zonas Conflicto · Exportaciones Oro · SAGRILAFT 3.0 · OCDE</div>
                                            </div>
                                        </div>
                                        <div class="apd-hdr-badges">
                                            <span class="apd-hdr-badge">RUCOM ANM</span>
                                            <span class="apd-hdr-badge">SAGRILAFT 3.0</span>
                                            <span class="apd-hdr-badge">OCDE Minerales</span>
                                        </div>
                                    </div>
                                    <div class="apd-body-wrap">
                                        <div class="apd-grid-min">
                                            <div class="apd-card-min apc-red">
                                                <div class="apc-head">
                                                    <div class="apc-icon apc-icon-red">🗺️</div>
                                                    <div>
                                                        <div class="apc-title">PT-1: Verificación Origen Geográfico y Control Armado</div>
                                                        <div class="apc-code">ANM · Decreto 1035/2024 · GDELT Zonas Conflicto</div>
                                                    </div>
                                                </div>
                                                <ul class="apc-steps">
                                                    <li>
                                                        <div class="step-chk chk-red">✓</div>Verificar municipio de origen del oro contra mapa de zonas de control armado. Chocó, Sur Bolívar, Bajo Cauca, Nariño y Cauca requieren certificación de mina libre de coacción de grupos ilegales (requisito ANM 2026)
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-red">✓</div>Cruzar contra índice de conflictividad GDELT. Municipio con eventos armados recientes = DDI reforzada obligatoria antes de cualquier transacción de compra
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-red">✓</div>Validar que la mina tiene título minero vigente en el Catastro Minero Colombiano. Mina sin título = producción de origen ilícito. Bloquear y reportar a UIAF y ANM inmediatamente
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="apd-card-min apc-teal">
                                                <div class="apc-head">
                                                    <div class="apc-icon apc-icon-teal">🔗</div>
                                                    <div>
                                                        <div class="apc-title">PT-2: Trazabilidad RUCOM y Plataforma ANM 2026</div>
                                                        <div class="apc-code">RUCOM · Génesis ANM · Control a la Producción</div>
                                                    </div>
                                                </div>
                                                <ul class="apc-steps">
                                                    <li>
                                                        <div class="step-chk chk-teal">✓</div>Exigir código único de transacción de la nueva plataforma ANM (RUCOM + Génesis) por cada compra de oro. Desde mayo 2026 es el mecanismo oficial. Sin código = origen no trazable, rechazar operación
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-teal">✓</div>Verificar que el minero de subsistencia no supera el límite de 420 gramos anuales. Superación sistemática sin escalonamiento = posible presta-nombre de operación minera ilegal mayor
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-teal">✓</div>Confirmar en el RUCOM que la comercializadora está activa y no figura en listas de inhabilitados de la ANM ni en el Listado Oficial de Proveedores Ficticios de la DIAN
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="apd-card-min apc-amber">
                                                <div class="apc-head">
                                                    <div class="apc-icon apc-icon-amber">📊</div>
                                                    <div>
                                                        <div class="apc-title">PT-3: Auditoría TBML Exportaciones de Oro</div>
                                                        <div class="apc-code">DIAN · LBMA Precio Spot · Banco de la República</div>
                                                    </div>
                                                </div>
                                                <ul class="apc-steps">
                                                    <li>
                                                        <div class="step-chk chk-amber">✓</div>Cruzar precio declarado en exportación (subpartida 7108.12) contra precio spot LBMA y cotización Banco de la República del día. Brecha &gt;5% descendente = subfacturación TBML. Exigir justificación técnica documentada
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-amber">✓</div>Verificar que las divisas retornan al país dentro del plazo legal. Exportaciones de oro sin reintegro de divisas = señal de que el diferencial se quedó en cuentas del exterior. Reportar a UIAF y DIAN
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-amber">✓</div>Validar que el exportador cumple con los requisitos de la Sociedad de Comercialización Internacional: informe anual MINCIT, fianza equivalente al 2% FOB, sistema de control de inventarios auditado
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="apd-card-min apc-green">
                                                <div class="apc-head">
                                                    <div class="apc-icon apc-icon-green">🌐</div>
                                                    <div>
                                                        <div class="apc-title">PT-4: SAGRILAFT 3.0 y Debida Diligencia OCDE</div>
                                                        <div class="apc-code">Supersociedades · SAGRILAFT 3.0 · Guía OCDE Minerales</div>
                                                    </div>
                                                </div>
                                                <ul class="apc-steps">
                                                    <li>
                                                        <div class="step-chk chk-green">✓</div>Verificar que la comercializadora o C.I. tiene implementado SAGRILAFT 3.0 y presenta ROS a la UIAF. La UIAF y Supersociedades han ampliado la obligación a comerciantes de metales y piedras preciosas del sector formal
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-green">✓</div>Exigir certificación de refinería internacional receptora (LBMA, DMCC o equivalente) que confirme que el oro fue recibido con due diligence de origen. Refinería sin certificación = riesgo de integración en cadena global
                                                    </li>
                                                    <li>
                                                        <div class="step-chk chk-green">✓</div>Aplicar los 5 pasos de la Guía OCDE: (1) establecer política, (2) identificar riesgos, (3) diseñar respuesta, (4) auditoría independiente, (5) reporte público de resultados
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="apd-footer-bar">
                                            <div class="apdf-item">
                                                <div class="apdf-icon">⚡</div>
                                                <div>
                                                    <div class="apdf-title">Minería: delito fuente del lavado — Art. 160 Código Minero</div>
                                                    <div class="apdf-body">El aprovechamiento ilícito de recursos mineros es delito fuente del lavado (Art. 160). La DIAN y UIAF han señalado que la minería ilegal es hoy la principal fuente del lavado en Colombia. Agrava pena del terrorismo cuando se financia con minería ilegal</div>
                                                </div>
                                            </div>
                                            <div class="apdf-item">
                                                <div class="apdf-icon">🔒</div>
                                                <div>
                                                    <div class="apdf-title">Decreto 1035/2024 — Destrucción maquinaria amarilla</div>
                                                    <div class="apdf-body">El Decreto 1035 de 2024 autoriza la destrucción in situ de maquinaria amarilla (retroexcavadoras, clasificadoras) usada en minería ilegal. El auditor debe verificar que la empresa no tiene equipos en zonas de control armado bajo flagrancia</div>
                                                </div>
                                            </div>
                                            <div class="apdf-item">
                                                <div class="apdf-icon">🌍</div>
                                                <div>
                                                    <div class="apdf-title">Presión internacional — LBMA y US Mint post-2026</div>
                                                    <div class="apdf-body">Tras el escándalo NYT/US Mint (abr 2026), los mercados internacionales exigen trazabilidad verificable externamente. Compradores europeos y estadounidenses requerirán certificación de cadena de suministro limpia como requisito de entrada al mercado</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="apd-escalation">
                                            <span style="font-size:20px;flex-shrink:0;">🚨</span>
                                            <div>
                                                <div class="esc-title">Oro sin trazabilidad RUCOM + municipio con control armado + subfacturación vs LBMA = Reporte ROS UIAF + Escalación a Fiscalía + Bloqueo inmediato de la transacción</div>
                                                <div class="esc-sub">La minería ilegal financia terrorismo (ELN, AGC, disidencias FARC). Transacciones con oro de origen no verificable exponen a la entidad a responsabilidad penal por financiamiento del terrorismo (Ley 1708/2014). El silencio equivale a dolo.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /sMin -->

                            <!-- ══ MODAL MATRIZ DE RIESGO MINERÍA ══ -->
                            <div class="min-modal-overlay" id="modalMineria">
                                <div class="min-modal">
                                    <div class="min-modal-head">
                                        <div class="min-modal-title">🗺️ Matriz de Riesgo — Sector Minero / Exportación 2025–2026</div>
                                        <button class="min-modal-close" onclick="closeMinModal()">✕</button>
                                    </div>
                                    <div class="min-modal-body">

                                        <div style="font-size:13px;font-weight:700;color:var(--eg-dark);margin-bottom:12px;padding-bottom:9px;border-bottom:2px solid var(--eg-teal-l);display:flex;align-items:center;gap:7px;"><span style="width:8px;height:8px;border-radius:50%;background:var(--eg-teal);flex-shrink:0;display:inline-block;"></span>Mapa de Calor — Probabilidad vs. Impacto</div>
                                        <div class="hm-grid-min" style="margin-bottom:12px;">
                                            <div class="hm-lbl-min"></div>
                                            <div class="hm-head-min">Bajo impacto</div>
                                            <div class="hm-head-min">Impacto medio</div>
                                            <div class="hm-head-min">Impacto alto</div>
                                            <div class="hm-head-min">Impacto crítico</div>

                                            <div class="hm-lbl-min">Prob. muy alta</div>
                                            <div class="hm-cell-min hm-high-min">Evasión regalías<br><span style="font-size:8px;opacity:.8;">Subregistro producción</span></div>
                                            <div class="hm-cell-min hm-critical-min">Mezcla oro legal-ilegal<br><span style="font-size:8px;opacity:.8;">Pérdida trazabilidad</span></div>
                                            <div class="hm-cell-min hm-critical-min">Control armado de minas<br><span style="font-size:8px;opacity:.8;">ELN/AGC/FARC</span></div>
                                            <div class="hm-cell-min hm-critical-min">Lavado vía exportaciones<br><span style="font-size:8px;opacity:.8;">+80% sin trazabilidad</span></div>

                                            <div class="hm-lbl-min">Prob. alta</div>
                                            <div class="hm-cell-min hm-medium-min">Maquinaria sin registro<br><span style="font-size:8px;opacity:.8;">Retroexcavadoras</span></div>
                                            <div class="hm-cell-min hm-high-min">Comercializadoras fachada<br><span style="font-size:8px;opacity:.8;">C.I. sin actividad real</span></div>
                                            <div class="hm-cell-min hm-critical-min">Subfacturación exportación<br><span style="font-size:8px;opacity:.8;">53t extra 2003-2011</span></div>
                                            <div class="hm-cell-min hm-critical-min">Financiamiento terrorismo<br><span style="font-size:8px;opacity:.8;">Vacuna por gramo</span></div>

                                            <div class="hm-lbl-min">Prob. media</div>
                                            <div class="hm-cell-min hm-low-min">Corrupción ANM licencias<br><span style="font-size:8px;opacity:.8;">Títulos zona protegida</span></div>
                                            <div class="hm-cell-min hm-medium-min">Trata personas en minas<br><span style="font-size:8px;opacity:.8;">Trabajo forzado</span></div>
                                            <div class="hm-cell-min hm-high-min">Convergencia coca-minería<br><span style="font-size:8px;opacity:.8;">44% EVOA con coca</span></div>
                                            <div class="hm-cell-min hm-high-min">Corrupción SGR regalías<br><span style="font-size:8px;opacity:.8;">Desvío fondo regalías</span></div>

                                            <div class="hm-lbl-min">Prob. baja</div>
                                            <div class="hm-cell-min hm-nil-min">—</div>
                                            <div class="hm-cell-min hm-low-min">Daño ambiental reportado<br><span style="font-size:8px;opacity:.8;">Pasivos sin cuantificar</span></div>
                                            <div class="hm-cell-min hm-medium-min">Demandas internacionales<br><span style="font-size:8px;opacity:.8;">Glencore USD 489M</span></div>
                                            <div class="hm-cell-min hm-high-min">Crisis diplomática oro<br><span style="font-size:8px;opacity:.8;">Presión EE.UU. NYT 2026</span></div>
                                        </div>
                                        <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:18px;">
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:#F09595;"></div>Crítico
                                            </div>
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:#FAC775;"></div>Alto
                                            </div>
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:#B5D4F4;"></div>Medio
                                            </div>
                                            <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                                <div style="width:10px;height:10px;border-radius:3px;background:#AADDD6;"></div>Bajo
                                            </div>
                                        </div>

                                        <div style="font-size:13px;font-weight:700;color:var(--eg-dark);margin-bottom:10px;padding-bottom:9px;border-bottom:2px solid var(--eg-teal-l);display:flex;align-items:center;gap:7px;"><span style="width:8px;height:8px;border-radius:50%;background:var(--red);flex-shrink:0;display:inline-block;"></span>Riesgos Operativos Críticos</div>
                                        <div style="overflow-x:auto;margin-bottom:18px;">
                                            <table class="plan-table-min">
                                                <tr>
                                                    <th>Riesgo</th>
                                                    <th>Factor específico</th>
                                                    <th>Nivel</th>
                                                    <th>Control Sugerido</th>
                                                    <th>Recomendación de Blindaje</th>
                                                </tr>
                                                <tr>
                                                    <td><strong>Mezcla oro legal / ilegal</strong></td>
                                                    <td style="font-size:10.5px;">Oro de zonas armadas mezclado antes de exportar. El oro funde y pierde trazabilidad</td>
                                                    <td><span class="pill-min-r">Crítico</span></td>
                                                    <td style="font-size:10.5px;">Plataforma ANM RUCOM + código único por transacción (may 2026)</td>
                                                    <td style="color:var(--red);font-weight:800;font-size:10.5px;">Certificación refinería LBMA obligatoria</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Subfacturación exportaciones</strong></td>
                                                    <td style="font-size:10.5px;">Declaración valor inferior al spot LBMA. Diferencial en cuentas exterior. 53 toneladas extra 2003–2011</td>
                                                    <td><span class="pill-min-r">Crítico</span></td>
                                                    <td style="font-size:10.5px;">Cruce precio spot LBMA vs declaración DIAN</td>
                                                    <td style="color:var(--red);font-weight:800;font-size:10.5px;">Verificación reintegro divisas obligatorio</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Comercializadoras sin trazabilidad</strong></td>
                                                    <td style="font-size:10.5px;">C.I. que compran oro a mineros sin verificar origen. La mitad de producción pasa por subsistencia</td>
                                                    <td><span class="pill-min-r">Crítico</span></td>
                                                    <td style="font-size:10.5px;">Verificación RUCOM activo + límite 420g/año subsistencia</td>
                                                    <td style="color:var(--red);font-weight:800;font-size:10.5px;">SAGRILAFT 3.0 + ROS UIAF obligatorio</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Evasión regalías</strong></td>
                                                    <td style="font-size:10.5px;">65% unidades mineras sin pagar regalías. Subregistro de producción real ante ANM y DIAN</td>
                                                    <td><span class="pill-min-a">Alto</span></td>
                                                    <td style="font-size:10.5px;">Control a la Producción integrado ANM 2026</td>
                                                    <td style="color:var(--eg-orange);font-weight:800;font-size:10.5px;">Auditoría producción real vs declarada</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Financiamiento grupos armados</strong></td>
                                                    <td style="font-size:10.5px;">ELN/AGC cobran vacuna por gramo. Alias "Calarcá" controla $50.000M en oro</td>
                                                    <td><span class="pill-min-r">Crítico</span></td>
                                                    <td style="font-size:10.5px;">Certificación mina libre de coacción armada (ANM 2026)</td>
                                                    <td style="color:var(--red);font-weight:800;font-size:10.5px;">Reporte inmediato Fiscalía + UIAF</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div style="font-size:13px;font-weight:700;color:var(--eg-dark);margin-bottom:10px;padding-bottom:9px;border-bottom:2px solid var(--eg-teal-l);display:flex;align-items:center;gap:7px;"><span style="width:8px;height:8px;border-radius:50%;background:var(--eg-teal);flex-shrink:0;display:inline-block;"></span>Plan de Acción SARLAFT / SAGRILAFT 3.0 — Sector Minero</div>
                                        <div style="overflow-x:auto;">
                                            <table class="plan-table-min">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Recomendación</th>
                                                    <th>Área</th>
                                                    <th>Plazo</th>
                                                    <th>Prioridad</th>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:var(--eg-teal);">R-1</td>
                                                    <td>Registrar en nueva plataforma ANM (RUCOM + Génesis) todas las transacciones de compra de oro desde may 2026</td>
                                                    <td>Operaciones</td>
                                                    <td><span class="plazo-tag">Inmediato</span></td>
                                                    <td><span class="pill-min-r">Crítica</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:var(--eg-teal);">R-2</td>
                                                    <td>Cruzar precio de exportación contra spot LBMA del día. Brecha &gt;5% = bloqueo y reporte DIAN + UIAF</td>
                                                    <td>Comercio ext.</td>
                                                    <td><span class="plazo-tag">Inmediato</span></td>
                                                    <td><span class="pill-min-r">Crítica</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:var(--eg-teal);">R-3</td>
                                                    <td>Implementar SAGRILAFT 3.0 completo. Enviar ROS UIAF por toda operación sospechosa en cadena del oro</td>
                                                    <td>Cumplimiento</td>
                                                    <td><span class="plazo-tag">30 días</span></td>
                                                    <td><span class="pill-min-r">Crítica</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:var(--eg-teal);">R-4</td>
                                                    <td>Certificar que la mina de origen está libre de control armado (requisito ANM 2026) antes de comprar</td>
                                                    <td>Vinculación</td>
                                                    <td><span class="plazo-tag">Inmediato</span></td>
                                                    <td><span class="pill-min-r">Crítica</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:var(--eg-teal);">R-5</td>
                                                    <td>Aplicar Guía OCDE para Cadenas de Suministro de Minerales. Exigir certificación LBMA/DMCC a refinería receptora</td>
                                                    <td>Exportaciones</td>
                                                    <td><span class="plazo-tag">60 días</span></td>
                                                    <td><span class="pill-min-a">Alta</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:var(--eg-teal);">R-6</td>
                                                    <td>Monitorear índice GDELT en municipios de operación. Alta conflictividad = DDI reforzada antes de cualquier compra</td>
                                                    <td>Riesgo</td>
                                                    <td><span class="plazo-tag">Continuo</span></td>
                                                    <td><span class="pill-min-a">Alta</span></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- ═══════════════════════════════════════════════════════════
     SECCIÓN sProp: PROPUESTA — PLAN DE PUESTA EN MARCHA
     Departamento de Control Interno SCI NAPLES · 6 meses
     Basado en: Normas Globales IIA 2024 · COSO ERM 2013
     Instituto de Auditores Internos de España · Feb 2026
═══════════════════════════════════════════════════════════ -->
                            <div class="section" id="sProp">

                                <!-- HERO PROPUESTA -->
                                <div style="background:linear-gradient(135deg,#3A7BD5 0%,#2962B8 100%);border-radius:var(--radius);padding:28px 26px;margin-bottom:18px;color:#fff;position:relative;overflow:hidden;">
                                    <div style="position:absolute;right:20px;top:50%;transform:translateY(-50%);font-size:80px;opacity:.08;">📋</div>
                                    <div style="font-size:11px;font-weight:800;letter-spacing:2px;text-transform:uppercase;opacity:.85;margin-bottom:8px;">Plan de Implementación · Sistema de Control Interno</div>
                                    <div style="font-size:21px;font-weight:700;margin-bottom:7px;line-height:1.2;">Propuesta Ejecutiva — Puesta en Marcha del Departamento de Control Interno SCI NAPLES</div>
                                    <div style="font-size:12px;opacity:.88;line-height:1.6;margin-bottom:16px;">Hoja de ruta integral de 6 meses · Basada en las Normas Globales IIA 2024 · COSO ERM 2013 · 57 riesgos identificados</div>
                                    <span style="display:inline-block;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.4);padding:4px 13px;border-radius:4px;font-size:10px;font-weight:800;margin-right:7px;margin-bottom:5px;letter-spacing:.5px;">📅 6 MESES</span>
                                    <span style="display:inline-block;background:rgba(201,53,53,.35);border:1px solid rgba(255,150,150,.5);padding:4px 13px;border-radius:4px;font-size:10px;font-weight:800;margin-right:7px;margin-bottom:5px;letter-spacing:.5px;">⚠ 9 RIESGOS EXTREMOS</span>
                                    <span style="display:inline-block;background:rgba(255,158,24,.3);border:1px solid rgba(255,200,100,.5);padding:4px 13px;border-radius:4px;font-size:10px;font-weight:800;margin-right:7px;margin-bottom:5px;letter-spacing:.5px;">🔶 38 RIESGOS ALTOS</span>
                                    <span style="display:inline-block;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);padding:4px 13px;border-radius:4px;font-size:10px;font-weight:800;margin-right:7px;margin-bottom:5px;letter-spacing:.5px;">📊 57 RIESGOS TOTALES</span>
                                    <span style="display:inline-block;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);padding:4px 13px;border-radius:4px;font-size:10px;font-weight:800;margin-bottom:5px;letter-spacing:.5px;">🏛 NORMAS GLOBALES IIA 2024</span>
                                </div>

                                <!-- KPIs DEL PLAN -->
                                <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:10px;margin-bottom:18px;">
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:12px 14px;border-left:4px solid #2962B8;">
                                        <div style="font-size:9.5px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Acciones totales</div>
                                        <div style="font-size:26px;font-weight:700;color:#2962B8;line-height:1;">47</div>
                                        <div style="font-size:9.5px;color:var(--muted);margin-top:2px;">En 6 meses de ejecución</div>
                                    </div>
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:12px 14px;border-left:4px solid var(--extreme);">
                                        <div style="font-size:9.5px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Controles zona extrema</div>
                                        <div style="font-size:26px;font-weight:700;color:var(--extreme);line-height:1;">9</div>
                                        <div style="font-size:9.5px;color:var(--muted);margin-top:2px;">Prioridad máxima · Mes 1–3</div>
                                    </div>
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:12px 14px;border-left:4px solid var(--high);">
                                        <div style="font-size:9.5px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Controles zona alta</div>
                                        <div style="font-size:26px;font-weight:700;color:var(--high);line-height:1;">38</div>
                                        <div style="font-size:9.5px;color:var(--muted);margin-top:2px;">Gestión prioritaria · Mes 3–6</div>
                                    </div>
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:12px 14px;border-left:4px solid var(--low);">
                                        <div style="font-size:9.5px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Módulos de capacitación</div>
                                        <div style="font-size:26px;font-weight:700;color:var(--low);line-height:1;">6</div>
                                        <div style="font-size:9.5px;color:var(--muted);margin-top:2px;">Todo el equipo directivo</div>
                                    </div>
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:12px 14px;border-left:4px solid var(--eg-teal);">
                                        <div style="font-size:9.5px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Semanas de ejecución</div>
                                        <div style="font-size:26px;font-weight:700;color:var(--eg-teal);line-height:1;">24</div>
                                        <div style="font-size:9.5px;color:var(--muted);margin-top:2px;">Cronograma estructurado</div>
                                    </div>
                                </div>

                                <!-- SEP: CRONOGRAMA -->
                                <div style="display:flex;align-items:center;gap:0;margin:0 0 14px;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(41,98,184,.1);">
                                    <div style="width:5px;background:#2962B8;align-self:stretch;min-height:34px;"></div>
                                    <div style="flex:1;padding:9px 16px;background:#EBF2FF;border:1.5px solid #90B4E8;border-left:none;border-radius:0 8px 8px 0;display:flex;align-items:center;gap:9px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:#1A3E7A;">
                                        <span style="font-size:16px;">📅</span>Cronograma de Implementación · 6 Meses — Fases y Hitos Críticos
                                    </div>
                                </div>

                                <!-- CRONOGRAMA VISUAL -->
                                <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:14px;overflow-x:auto;">
                                    <div style="display:grid;grid-template-columns:160px repeat(6,1fr);gap:3px;min-width:700px;font-size:10px;">
                                        <!-- Encabezados meses -->
                                        <div style="background:#2962B8;color:#fff;padding:7px 10px;border-radius:6px 0 0 6px;font-weight:800;font-size:10px;display:flex;align-items:center;">ACTIVIDAD / FASE</div>
                                        <div style="background:#2962B8;color:#fff;padding:7px 6px;text-align:center;font-weight:800;">MES 1<br><span style="font-size:8px;opacity:.8;">Diagnóstico</span></div>
                                        <div style="background:#2962B8;color:#fff;padding:7px 6px;text-align:center;font-weight:800;">MES 2<br><span style="font-size:8px;opacity:.8;">Bases SCI</span></div>
                                        <div style="background:#1B4D9A;color:#fff;padding:7px 6px;text-align:center;font-weight:800;">MES 3<br><span style="font-size:8px;opacity:.8;">Ctrl Extremo</span></div>
                                        <div style="background:#1B4D9A;color:#fff;padding:7px 6px;text-align:center;font-weight:800;">MES 4<br><span style="font-size:8px;opacity:.8;">Ctrl Alto I</span></div>
                                        <div style="background:#143A75;color:#fff;padding:7px 6px;text-align:center;font-weight:800;">MES 5<br><span style="font-size:8px;opacity:.8;">Ctrl Alto II</span></div>
                                        <div style="background:#143A75;color:#fff;padding:7px 6px;text-align:center;font-weight:800;border-radius:0 6px 6px 0;">MES 6<br><span style="font-size:8px;opacity:.8;">PAMC/Cierre</span></div>
                                        <!-- Fila 1 -->
                                        <div style="background:#EBF2FF;padding:7px 10px;font-weight:700;color:#1A3E7A;border-radius:4px;font-size:10px;">Diagnóstico y mapeo SCI</div>
                                        <div style="background:#2962B8;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●●●</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <!-- Fila 2 -->
                                        <div style="background:#EBF2FF;padding:7px 10px;font-weight:700;color:#1A3E7A;border-radius:4px;font-size:10px;">Estatuto y estructura SCI</div>
                                        <div style="background:#2962B8;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●</div>
                                        <div style="background:#2962B8;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <!-- Fila 3 -->
                                        <div style="background:#FFEBEE;padding:7px 10px;font-weight:700;color:#7A1A1A;border-radius:4px;font-size:10px;">Controles riesgo EXTREMO</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#C0392B;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">▶▶</div>
                                        <div style="background:#C0392B;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●●●</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <!-- Fila 4 -->
                                        <div style="background:#FFF8E1;padding:7px 10px;font-weight:700;color:#7A4800;border-radius:4px;font-size:10px;">Controles riesgo ALTO I</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#E67E22;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">▶</div>
                                        <div style="background:#E67E22;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●●●</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <!-- Fila 5 -->
                                        <div style="background:#FFF8E1;padding:7px 10px;font-weight:700;color:#7A4800;border-radius:4px;font-size:10px;">Controles riesgo ALTO II</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#E67E22;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">▶</div>
                                        <div style="background:#E67E22;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●●●</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <!-- Fila 6 -->
                                        <div style="background:#E8F5E9;padding:7px 10px;font-weight:700;color:#1B5E20;border-radius:4px;font-size:10px;">Plan de capacitación</div>
                                        <div style="background:#27AE60;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">M1</div>
                                        <div style="background:#27AE60;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">M2</div>
                                        <div style="background:#27AE60;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">M3</div>
                                        <div style="background:#27AE60;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">M4</div>
                                        <div style="background:#27AE60;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">M5</div>
                                        <div style="background:#27AE60;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">M6</div>
                                        <!-- Fila 7 -->
                                        <div style="background:#E0F8F9;padding:7px 10px;font-weight:700;color:#005A5E;border-radius:4px;font-size:10px;">PAMC y evaluación calidad</div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#e8ecf0;border-radius:4px;"></div>
                                        <div style="background:#00BAC3;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">▶</div>
                                        <div style="background:#00BAC3;color:#fff;padding:6px 4px;text-align:center;border-radius:4px;font-weight:800;">●●●●</div>
                                    </div>
                                    <div style="display:flex;gap:14px;margin-top:12px;flex-wrap:wrap;">
                                        <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                            <div style="width:10px;height:10px;border-radius:2px;background:#2962B8;"></div>Diagnóstico / Bases
                                        </div>
                                        <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                            <div style="width:10px;height:10px;border-radius:2px;background:#C0392B;"></div>Zona Extrema
                                        </div>
                                        <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                            <div style="width:10px;height:10px;border-radius:2px;background:#E67E22;"></div>Zona Alta
                                        </div>
                                        <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                            <div style="width:10px;height:10px;border-radius:2px;background:#27AE60;"></div>Capacitación continua
                                        </div>
                                        <div style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--muted);font-weight:700;">
                                            <div style="width:10px;height:10px;border-radius:2px;background:#00BAC3;"></div>PAMC / Cierre
                                        </div>
                                    </div>
                                </div>

                                <!-- SEP: ÁREAS FUNCIONALES -->
                                <div style="display:flex;align-items:center;gap:0;margin:0 0 14px;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(201,53,53,.1);">
                                    <div style="width:5px;background:var(--extreme);align-self:stretch;min-height:34px;"></div>
                                    <div style="flex:1;padding:9px 16px;background:var(--red-l);border:1.5px solid var(--red-m);border-left:none;border-radius:0 8px 8px 0;display:flex;align-items:center;gap:9px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:#7A1A1A;">
                                        <span style="font-size:16px;">🏢</span>Plan de Acción por Área Funcional — Riesgos Extremos y Altos · Controles y Pruebas
                                    </div>
                                </div>

                                <!-- TABLA ÁREAS FUNCIONALES -->
                                <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:14px;overflow-x:auto;">
                                    <table style="width:100%;border-collapse:collapse;font-size:11px;min-width:760px;">
                                        <thead>
                                            <tr>
                                                <th style="background:#2962B8;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1A4A9A;font-weight:800;">Área / Proceso</th>
                                                <th style="background:#2962B8;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1A4A9A;font-weight:800;">Riesgos Críticos</th>
                                                <th style="background:#2962B8;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1A4A9A;font-weight:800;">Acción Prioritaria</th>
                                                <th style="background:#2962B8;color:#fff;padding:8px 10px;text-align:center;font-size:9.5px;border:1px solid #1A4A9A;font-weight:800;">Tipo Control</th>
                                                <th style="background:#2962B8;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1A4A9A;font-weight:800;">Prueba de Auditoría</th>
                                                <th style="background:#2962B8;color:#fff;padding:8px 10px;text-align:center;font-size:9.5px;border:1px solid #1A4A9A;font-weight:800;">Mes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background:#FFEBEE;">
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-weight:800;color:#7A1A1A;font-size:10.5px;">DRC.001 · Riesgo y Cumplimiento</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;"><span style="background:#FFEBEE;color:#B71C1C;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-1 Extremo</span><br><span style="font-size:10px;color:var(--muted);">RSCI-4, 5, 6 Alto</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10.5px;font-weight:600;color:var(--text);">Implementar protocolo Debida Diligencia SAGRILAFT. Verificar contrapartes en listas restrictivas UIAF/OFAC. Formalizar cronograma UIAF/SuperSociedades.</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span><br><span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;margin-top:3px;display:inline-block;">Detectivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10px;color:var(--muted);font-weight:600;">Walkthrough del proceso de vinculación · Revisión de expedientes de contrapartes · Verificación en listas UIAF · Confirmación de reportes periódicos</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#2962B8;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M1–M2</span></td>
                                            </tr>
                                            <tr style="background:#fff8e8;">
                                                <td style="padding:8px 10px;border:1px solid #f0e0c0;font-weight:800;color:#7A3800;font-size:10.5px;">DJUR.002 · Dirección Jurídica</td>
                                                <td style="padding:8px 10px;border:1px solid #f0e0c0;"><span style="background:#FFF3E0;color:#E65100;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-9 Alto</span><br><span style="font-size:10px;color:var(--muted);">RSCI-10 Alto</span></td>
                                                <td style="padding:8px 10px;border:1px solid #f0e0c0;font-size:10.5px;font-weight:600;color:var(--text);">Revisar contratos vigentes con checklist legal. Implementar control de libros societarios. Formalizar proceso de circularización de procesos judiciales.</td>
                                                <td style="padding:8px 10px;border:1px solid #f0e0c0;text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid #f0e0c0;font-size:10px;color:var(--muted);font-weight:600;">Revisión documental de contratos · Verificación de libros de actas · Circularización con apoderados · Análisis de cláusulas de riesgo</td>
                                                <td style="padding:8px 10px;border:1px solid #f0e0c0;text-align:center;"><span style="background:#2962B8;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M2–M3</span></td>
                                            </tr>
                                            <tr style="background:#FAFCFD;">
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:var(--text);font-size:10.5px;">GH.003 · Gestión Humana</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);"><span style="background:#FFF3E0;color:#E65100;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-14 Alto</span><br><span style="font-size:10px;color:var(--muted);">RSCI-13, 16, 17 Alto</span></td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;font-weight:600;color:var(--text);">Diseñar matriz de segregación de funciones. Formalizar proceso de selección con pruebas técnicas. Implementar programa de capacitación anual y plan de backup.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10px;color:var(--muted);font-weight:600;">Revisión de perfiles de cargo vs. funciones reales · Análisis de conflictos de interés · Verificación de nómina y aportes parafiscales · Revisión cumplimiento SG-SST</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#2962B8;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M2–M4</span></td>
                                            </tr>
                                            <tr style="background:#FFEBEE;">
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-weight:800;color:#7A1A1A;font-size:10.5px;">DFC.004 · Financiero y Contable</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;"><span style="background:#FFEBEE;color:#B71C1C;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-25, 26, 31 Extremo</span><br><span style="font-size:10px;color:var(--muted);">RSCI-19–24, 29–33 Alto</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10.5px;font-weight:600;color:var(--text);">Documentar política de planeación financiera. Formalizar controles de tesorería y operaciones autorizadas. Implementar conciliaciones bancarias periódicas y matriz de aprobaciones.</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span><br><span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;margin-top:3px;display:inline-block;">Detectivo</span><br><span style="background:#FFF3E0;color:#E65100;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;margin-top:3px;display:inline-block;">Correctivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10px;color:var(--muted);font-weight:600;">Prueba de operaciones · Revisión de autorizaciones de pagos · Conciliación de cuentas bancarias · Verificación de cumplimiento tributario · Análisis de razonabilidad NIIF · Revisión de activos fijos</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#C0392B;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M2–M3</span></td>
                                            </tr>
                                            <tr style="background:#FFEBEE;">
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-weight:800;color:#7A1A1A;font-size:10.5px;">CRL.005 · Dirección Comercial</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;"><span style="background:#FFEBEE;color:#B71C1C;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-35, 36, 45 Extremo</span><br><span style="font-size:10px;color:var(--muted);">RSCI-34, 37–44 Alto</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10.5px;font-weight:600;color:var(--text);">Establecer política de coberturas financieras. Implementar controles de acceso al laboratorio. Formalizar procedimiento de trazabilidad de inventarios y análisis de material.</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span><br><span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;margin-top:3px;display:inline-block;">Detectivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10px;color:var(--muted);font-weight:600;">Prueba de trazabilidad de inventarios · Verificación de accesos al laboratorio · Revisión de coberturas financieras · Análisis de riesgo de mercado · Inspección física del sitio de operación</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#C0392B;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M2–M4</span></td>
                                            </tr>
                                            <tr style="background:#FFEBEE;">
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-weight:800;color:#7A1A1A;font-size:10.5px;">ASG.006 · TI y Sostenibilidad</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;"><span style="background:#FFEBEE;color:#B71C1C;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-48 Extremo</span><br><span style="font-size:10px;color:var(--muted);">RSCI-46, 47, 49–54 Alto</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10.5px;font-weight:600;color:var(--text);">Implementar protocolos de ciberseguridad y política de seguridad de la información. Formalizar plan de copias de seguridad automáticas. Diseñar plan de sostenibilidad ASG.</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span><br><span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;margin-top:3px;display:inline-block;">Detectivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;font-size:10px;color:var(--muted);font-weight:600;">Revisión de controles de acceso lógico · Prueba de restauración de copias de seguridad · Análisis de vulnerabilidades · Verificación de licencias vigentes · Revisión plan de sostenibilidad</td>
                                                <td style="padding:8px 10px;border:1px solid #e2e8f0;text-align:center;"><span style="background:#C0392B;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M3–M4</span></td>
                                            </tr>
                                            <tr style="background:#FAFCFD;">
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:var(--text);font-size:10.5px;">DOLN.007 · Otras Líneas Negocio</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);"><span style="background:#FFF3E0;color:#E65100;padding:2px 8px;border-radius:10px;font-size:9px;font-weight:800;">RSCI-55 Alto</span><br><span style="font-size:10px;color:var(--muted);">RSCI-56, 57 Moderado</span></td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;font-weight:600;color:var(--text);">Documentar plan de negocio y presupuesto por línea. Formalizar procedimiento para envío de muestras al exterior. Definir mecanismo de seguimiento de asignaciones de Gerencia.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span></td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10px;color:var(--muted);font-weight:600;">Revisión de planes de negocio aprobados · Verificación de documentación de envíos al exterior · Revisión de bitácora de asignaciones y cumplimiento · Entrevistas con Gerencia</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#2962B8;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">M4–M5</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- SEP: FICHAS RIESGOS EXTREMOS -->
                                <div style="display:flex;align-items:center;gap:0;margin:0 0 14px;border-radius:8px;overflow:hidden;">
                                    <div style="width:5px;background:var(--extreme);align-self:stretch;min-height:34px;"></div>
                                    <div style="flex:1;padding:9px 16px;background:var(--red-l);border:1.5px solid var(--red-m);border-left:none;border-radius:0 8px 8px 0;display:flex;align-items:center;gap:9px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:#7A1A1A;">
                                        <span style="font-size:16px;">⚠</span>Fichas de Control — 9 Riesgos en Zona Extrema · Acción Ejecutiva Inmediata
                                    </div>
                                </div>

                                <!-- GRID FICHAS EXTREMOS -->
                                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:18px;">

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-1 · DRC.001 · Score: 15</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Vinculación de contrapartes con actividades LAFT</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Fallas en la debida diligencia de contrapartes.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Detectivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Walkthrough proceso vinculación · Verificación listas UIAF/OFAC · Revisión expedientes</div>
                                        <div style="font-size:10px;font-weight:800;color:#2962B8;">Control actual: Óptimo (100) ✓ · Mantener y verificar</div>
                                        <div style="background:#EBF2FF;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#1A3E7A;display:inline-block;">Mes 1–2</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-25 · DFC.004 · Score: 15</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Incumplimiento en presentación y pago de obligaciones tributarias</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Falta de presupuesto y programación para el pago fiscal.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Revisión calendario tributario · Verificación pagos vs. declaraciones DIAN · Análisis presupuesto fiscal</div>
                                        <div style="font-size:10px;font-weight:800;color:#27AE60;">Control actual: Óptimo (85) ✓ · Verificar ejecución</div>
                                        <div style="background:#EBF2FF;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#1A3E7A;display:inline-block;">Mes 2–3</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-26 · DFC.004 · Score: 15 ⚠ CONTROL INACEPTABLE</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Falta de planeación financiera</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Fallas en presupuesto y estrategias financieras del año gravable.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#FFF3E0;color:#E65100;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Correctivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Verificar existencia de plan financiero aprobado · Revisión de presupuesto vs. ejecución real · Análisis de proyecciones</div>
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;">Control actual: INACEPTABLE (0) 🚨 · ACCIÓN INMEDIATA</div>
                                        <div style="background:#FFEBEE;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#B71C1C;display:inline-block;">Mes 1 — Urgente</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-31 · DFC.004 · Score: 15</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Operaciones no autorizadas</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Incumplimiento en políticas de tesorería.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Detectivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Prueba de segregación de funciones en tesorería · Revisión de matriz de aprobaciones · Muestra de transacciones vs. autorizaciones</div>
                                        <div style="font-size:10px;font-weight:800;color:#E67E22;">Control actual: Bueno (55) · Fortalecer controles</div>
                                        <div style="background:#EBF2FF;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#1A3E7A;display:inline-block;">Mes 2–3</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-35 · CRL.005 · Score: 20 ★ MAYOR SCORE</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Riesgo de mercado en cierres de negociaciones</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Variaciones y fluctuaciones de precios y tasas de mercado. Prob. 5 (Casi cierto).</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Detectivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Revisión de política de coberturas · Análisis de contratos de cobertura financiera · Backtesting de operaciones de mercado · Análisis de sensibilidad</div>
                                        <div style="font-size:10px;font-weight:800;color:#E67E22;">Control actual: Bueno (50) · Insuficiente — Escalar a Gerencia</div>
                                        <div style="background:#FFEBEE;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#B71C1C;display:inline-block;">Mes 1 — Prioridad Gerencia</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-36 · CRL.005 · Score: 16 ⚠ CONTROL INACEPTABLE</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Restricción de coberturas financieras</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: No mantener indicadores financieros favorables y reputación negativa.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#FFF3E0;color:#E65100;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Correctivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Revisión de indicadores financieros KRI · Análisis de disponibilidad de líneas de crédito · Evaluación de reputación crediticia</div>
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;">Control actual: INACEPTABLE (0) 🚨 · ACCIÓN INMEDIATA</div>
                                        <div style="background:#FFEBEE;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#B71C1C;display:inline-block;">Mes 1 — Urgente</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-45 · CRL.005 · Score: 15</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Vulnerabilidad en la seguridad del sitio del laboratorio</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Incumplimiento de políticas de seguridad para custodiar el material.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Detectivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Inspección física del laboratorio · Verificación de controles de acceso · Revisión de política de seguridad física · Entrevistas con personal de seguridad</div>
                                        <div style="font-size:10px;font-weight:800;color:#E67E22;">Control actual: Bueno (55) · Reforzar accesos y custodias</div>
                                        <div style="background:#EBF2FF;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#1A3E7A;display:inline-block;">Mes 3–4</div>
                                    </div>

                                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:4px solid var(--extreme);border-radius:8px;padding:13px 14px;">
                                        <div style="font-size:10px;font-weight:800;color:#B71C1C;margin-bottom:4px;">RSCI-48 · ASG.006 · Score: 15</div>
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:5px;line-height:1.3;">Ataque cibernético</div>
                                        <div style="font-size:10px;color:var(--muted);margin-bottom:6px;line-height:1.4;">Causa: Falta de protocolos de seguridad informática.</div>
                                        <div style="display:flex;gap:5px;flex-wrap:wrap;margin-bottom:5px;">
                                            <span style="background:#E3F2FD;color:#0D47A1;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Preventivo</span>
                                            <span style="background:#E8F5E9;color:#1B5E20;padding:2px 7px;border-radius:4px;font-size:9px;font-weight:800;">Detectivo</span>
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:4px;"><strong style="color:var(--text);">Prueba:</strong> Revisión de política de ciberseguridad · Prueba de penetración básica · Verificación de backups · Análisis de controles de acceso lógico</div>
                                        <div style="font-size:10px;font-weight:800;color:#E67E22;">Control actual: Bueno (55) · Implementar protocolos formales</div>
                                        <div style="background:#EBF2FF;border-radius:4px;padding:4px 8px;margin-top:5px;font-size:9.5px;font-weight:800;color:#1A3E7A;display:inline-block;">Mes 3–4</div>
                                    </div>

                                    <!-- Alerta resumen 2 inaceptables -->
                                    <div style="background:#FFEBEE;border:2px solid var(--extreme);border-radius:8px;padding:13px 14px;display:flex;flex-direction:column;justify-content:center;">
                                        <div style="font-size:11px;font-weight:800;color:#B71C1C;margin-bottom:8px;">🚨 Alerta Ejecutiva — Controles Inaceptables</div>
                                        <div style="font-size:11px;color:var(--text);font-weight:600;line-height:1.6;margin-bottom:10px;">Dos riesgos extremos tienen control calificado como <strong>Inaceptable (0 puntos)</strong>: no existe documentación, aplicación ni efectividad comprobada. Requieren plan de acción correctiva en el <strong>Mes 1</strong>, con responsable designado y fecha límite de entrega.</div>
                                        <div style="background:#fff;border-radius:6px;padding:8px 10px;font-size:10px;font-weight:700;color:#7A1A1A;border-left:3px solid var(--extreme);">RSCI-26 · Falta de planeación financiera · DFC.004</div>
                                        <div style="background:#fff;border-radius:6px;padding:8px 10px;font-size:10px;font-weight:700;color:#7A1A1A;border-left:3px solid var(--extreme);margin-top:6px;">RSCI-36 · Restricción de coberturas financieras · CRL.005</div>
                                    </div>

                                </div>

                                <!-- SEP: PLAN DE CAPACITACIÓN -->
                                <div style="display:flex;align-items:center;gap:0;margin:0 0 14px;border-radius:8px;overflow:hidden;">
                                    <div style="width:5px;background:var(--low);align-self:stretch;min-height:34px;"></div>
                                    <div style="flex:1;padding:9px 16px;background:#E8F5E9;border:1.5px solid #A5D6A7;border-left:none;border-radius:0 8px 8px 0;display:flex;align-items:center;gap:9px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:#1B5E20;">
                                        <span style="font-size:16px;">🎓</span>Plan de Capacitación — Control Interno para el Equipo Directivo · 6 Módulos Transversales
                                    </div>
                                </div>

                                <!-- TABLA CAPACITACIÓN -->
                                <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:18px 20px;margin-bottom:18px;overflow-x:auto;">
                                    <table style="width:100%;border-collapse:collapse;font-size:11px;min-width:700px;">
                                        <thead>
                                            <tr>
                                                <th style="background:#27AE60;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1E8449;font-weight:800;">#</th>
                                                <th style="background:#27AE60;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1E8449;font-weight:800;">Módulo de Capacitación</th>
                                                <th style="background:#27AE60;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1E8449;font-weight:800;">Participantes</th>
                                                <th style="background:#27AE60;color:#fff;padding:8px 10px;text-align:left;font-size:9.5px;border:1px solid #1E8449;font-weight:800;">Objetivo</th>
                                                <th style="background:#27AE60;color:#fff;padding:8px 10px;text-align:center;font-size:9.5px;border:1px solid #1E8449;font-weight:800;">Duración</th>
                                                <th style="background:#27AE60;color:#fff;padding:8px 10px;text-align:center;font-size:9.5px;border:1px solid #1E8449;font-weight:800;">Mes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:#1B5E20;text-align:center;">M1</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:700;color:var(--text);">Fundamentos del Control Interno — Marco COSO ERM 2013 y Normas Globales IIA 2024</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--muted);">Todo el equipo directivo (7 Direcciones + Gerencia)</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--text);">Alinear a la Alta Dirección con los conceptos, propósito y valor del SCI. Comprender los 5 componentes COSO y los roles de las tres líneas.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;font-weight:700;">8 horas</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#27AE60;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">Mes 1</span></td>
                                            </tr>
                                            <tr style="background:#FAFCFD;">
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:#1B5E20;text-align:center;">M2</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:700;color:var(--text);">Gestión de Riesgos y Mapa de Riesgos SCI NAPLES — Lectura e Interpretación</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--muted);">Directores de área + Líderes de proceso</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--text);">Capacitar a cada director en la lectura del mapa de riesgos de su área. Interpretar probabilidad, impacto, zonas y acciones requeridas según los 57 riesgos SCI.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;font-weight:700;">6 horas</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#27AE60;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">Mes 1</span></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:#1B5E20;text-align:center;">M3</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:700;color:var(--text);">Diseño e Implementación de Controles — Preventivos, Detectivos y Correctivos</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--muted);">Directores de área + Responsables de primera línea</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--text);">Enseñar a diseñar controles efectivos para cada riesgo identificado. Diferenciar los tipos de control y establecer responsables por proceso. Aplicar walkthroughs.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;font-weight:700;">8 horas</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#27AE60;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">Mes 2</span></td>
                                            </tr>
                                            <tr style="background:#FAFCFD;">
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:#1B5E20;text-align:center;">M4</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:700;color:var(--text);">Ética, Código de Conducta y Cultura de Control Interno</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--muted);">Todo el equipo directivo + Gerencia General</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--text);">Fortalecer la cultura organizacional de integridad y control. Comprender el rol del Código de Ética, los conflictos de interés y los canales de denuncia en el marco SCI.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;font-weight:700;">4 horas</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#27AE60;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">Mes 3</span></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:#1B5E20;text-align:center;">M5</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:700;color:var(--text);">KPIs / KRIs de Seguimiento y Reporte a Órganos de Gobierno</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--muted);">Directores de área + Gerencia + Revisoría Fiscal</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--text);">Definir y calcular los indicadores clave de riesgo y desempeño del SCI. Establecer el modelo de reporte periódico a Gerencia y a la Revisoría Fiscal.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;font-weight:700;">6 horas</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#27AE60;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">Mes 4</span></td>
                                            </tr>
                                            <tr style="background:#FAFCFD;">
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:800;color:#1B5E20;text-align:center;">M6</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-weight:700;color:var(--text);">Programa de Aseguramiento y Mejora de la Calidad (PAMC) — Cierre y Evaluación</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--muted);">Todo el equipo directivo + Responsable SCI</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);font-size:10.5px;color:var(--text);">Evaluar el funcionamiento del SCI al cierre de los 6 meses. Identificar brechas, plan de mejora continua y proyección del Plan de Auditoría Interna para el siguiente período.</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;font-weight:700;">8 horas</td>
                                                <td style="padding:8px 10px;border:1px solid var(--border);text-align:center;"><span style="background:#27AE60;color:#fff;padding:3px 9px;border-radius:4px;font-size:9.5px;font-weight:800;">Mes 6</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- SEP: BASES INSTITUCIONALES -->
                                <div style="display:flex;align-items:center;gap:0;margin:0 0 14px;border-radius:8px;overflow:hidden;">
                                    <div style="width:5px;background:var(--eg-teal);align-self:stretch;min-height:34px;"></div>
                                    <div style="flex:1;padding:9px 16px;background:var(--eg-teal-l);border:1.5px solid var(--eg-teal-m);border-left:none;border-radius:0 8px 8px 0;display:flex;align-items:center;gap:9px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:var(--eg-teal-d);">
                                        <span style="font-size:16px;">🏛</span>Bases Institucionales del SCI — Estatuto · Misión · Posicionamiento · PAMC
                                    </div>
                                </div>

                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:16px 18px;">
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:10px;padding-bottom:8px;border-bottom:2px solid var(--eg-teal-l);display:flex;align-items:center;gap:7px;"><span style="width:8px;height:8px;border-radius:50%;background:var(--eg-teal);display:inline-block;"></span>Estatuto de Auditoría Interna / SCI</div>
                                        <div style="display:flex;flex-direction:column;gap:7px;">
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#E0F8F9;border-radius:6px;border-left:3px solid var(--eg-teal);">Misión: Agregar valor mediante aseguramiento objetivo e independiente del gobierno, gestión de riesgos y control interno de SCI NAPLES.</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Dependencia funcional: Gerencia General / Junta Directiva</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Dependencia administrativa: Gerencia General</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Salvaguardas de independencia: Acceso irrestricto a información · Sin restricción de alcance · Sin participación en operaciones auditadas</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Universo Auditable: 57 riesgos · 7 procesos · 10 subprocesos críticos · Ciclo completo de aprovisionamiento</div>
                                        </div>
                                    </div>
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:16px 18px;">
                                        <div style="font-size:12px;font-weight:700;color:var(--text);margin-bottom:10px;padding-bottom:8px;border-bottom:2px solid var(--eg-teal-l);display:flex;align-items:center;gap:7px;"><span style="width:8px;height:8px;border-radius:50%;background:var(--eg-green);display:inline-block;"></span>PAMC — Programa de Aseguramiento y Mejora de la Calidad</div>
                                        <div style="display:flex;flex-direction:column;gap:7px;">
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#E0F5F0;border-radius:6px;border-left:3px solid var(--eg-green);">Evaluaciones internas continuas: Supervisión mensual de papeles de trabajo y hallazgos</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Evaluación interna periódica: Autoevaluación trimestral contra Normas Globales IIA 2024</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Evaluación externa: Revisión por par externo al concluir el primer año de operación</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">KPIs del SCI: % riesgos extremos con control implementado · % hallazgos cerrados en plazo · % cobertura del Universo Auditable</div>
                                            <div style="font-size:10.5px;color:var(--text);font-weight:600;padding:6px 10px;background:#f8f9fa;border-radius:6px;">Reporte a órganos de gobierno: Informe trimestral a Gerencia + Informe anual a Revisoría Fiscal</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BUENAS PRÁCTICAS CLAVE -->
                                <div style="background:linear-gradient(135deg,#EBF2FF 0%,#E0F8F9 100%);border:1.5px solid #90B4E8;border-radius:var(--radius);padding:18px 20px;margin-bottom:6px;">
                                    <div style="font-size:12px;font-weight:800;color:#1A3E7A;margin-bottom:12px;display:flex;align-items:center;gap:8px;"><span style="font-size:16px;">⭐</span>Buenas Prácticas Clave — Normas Globales IIA 2024 para el Éxito del SCI NAPLES</div>
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                                        <div style="display:flex;align-items:flex-start;gap:8px;font-size:10.5px;color:var(--text);font-weight:600;"><span style="width:18px;height:18px;border-radius:4px;background:#2962B8;color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;margin-top:1px;">1</span>Obtener aprobación formal del Estatuto SCI por la Gerencia General en el Mes 1 antes de iniciar cualquier trabajo de campo.</div>
                                        <div style="display:flex;align-items:flex-start;gap:8px;font-size:10.5px;color:var(--text);font-weight:600;"><span style="width:18px;height:18px;border-radius:4px;background:#2962B8;color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;margin-top:1px;">2</span>Priorizar los 3 controles inaceptables (RSCI-26, RSCI-36) con plan de acción correctiva documentado en las primeras dos semanas.</div>
                                        <div style="display:flex;align-items:flex-start;gap:8px;font-size:10.5px;color:var(--text);font-weight:600;"><span style="width:18px;height:18px;border-radius:4px;background:#27AE60;color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;margin-top:1px;">3</span>La capacitación directiva (Módulos M1 y M2) debe realizarse en el Mes 1 para garantizar el compromiso y comprensión de la Alta Dirección.</div>
                                        <div style="display:flex;align-items:flex-start;gap:8px;font-size:10.5px;color:var(--text);font-weight:600;"><span style="width:18px;height:18px;border-radius:4px;background:#27AE60;color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;margin-top:1px;">4</span>Mantener absoluta independencia funcional del SCI: ningún miembro del equipo puede participar en procesos que luego sean objeto de revisión.</div>
                                        <div style="display:flex;align-items:flex-start;gap:8px;font-size:10.5px;color:var(--text);font-weight:600;"><span style="width:18px;height:18px;border-radius:4px;background:var(--eg-teal);color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;margin-top:1px;">5</span>Actualizar el mapa de riesgos al menos una vez durante el período de implementación para incorporar riesgos emergentes y cambios en el entorno.</div>
                                        <div style="display:flex;align-items:flex-start;gap:8px;font-size:10.5px;color:var(--text);font-weight:600;"><span style="width:18px;height:18px;border-radius:4px;background:var(--eg-teal);color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;flex-shrink:0;margin-top:1px;">6</span>Documentar todos los papeles de trabajo bajo estándares IIA: objetivo, alcance, criterio, hallazgo, causa, efecto y recomendación para cada prueba realizada.</div>
                                    </div>
                                </div>

                            </div>
                            <div class="section" id="sManual">

                                <div style="background:linear-gradient(135deg,#0f172a 0%,#0b1220 100%);border-radius:10px;padding:10px 24px;margin-bottom:16px;text-align:center;border-bottom:3px solid #06b6d4;">
                                    <div style="font-size:22px;font-weight:700;color:#fff;letter-spacing:.4px;">Manual de Control Interno</div>
                                </div>

                                <div style="display:grid;grid-template-columns:200px 1fr;gap:14px;align-items:start;">

                                    <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                                        <div style="background:#0f172a;color:#fff;padding:10px 14px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:1px;">📋 Tabla de Contenido</div>
                                        <div id="btn-t1" onclick="mnTab('t1')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">📖</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 1</span>Glosario</span>
                                        </div>
                                        <div id="btn-t2" onclick="mnTab('t2')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">📝</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 2</span>Introducción</span>
                                        </div>
                                        <div id="btn-t3" onclick="mnTab('t3')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">🏢</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 3</span>Generalidades</span>
                                        </div>
                                        <div id="btn-t4" onclick="mnTab('t4')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">🎯</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 4–5</span>Objetivos</span>
                                        </div>
                                        <div id="btn-t5" onclick="mnTab('t5')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">📐</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 6</span>Alcance</span>
                                        </div>
                                        <div id="btn-t6" onclick="mnTab('t6')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">⚖️</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 7</span>Principios</span>
                                        </div>
                                        <div id="btn-t7" onclick="mnTab('t7')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">✅</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 8</span>Efectividad</span>
                                        </div>
                                        <div id="btn-t8" onclick="mnTab('t8')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">📜</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 9</span>Política SCI</span>
                                        </div>
                                        <div id="btn-t9" onclick="mnTab('t9')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">👥</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 10</span>Funciones</span>
                                        </div>
                                        <div id="btn-t10" onclick="mnTab('t10')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">🏛</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Cap. 11</span>Comp. COSO</span>
                                        </div>
                                        <div id="btn-t11" onclick="mnTab('t11')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">🗂</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Anexo</span>Organigrama</span>
                                        </div>
                                        <div id="btn-t12" onclick="mnTab('t12')" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:11px;font-weight:600;color:#3D4543;border-bottom:1px solid #f1f5f9;cursor:pointer;transition:all .15s;">
                                            <span style="font-size:13px;flex-shrink:0;width:18px;">📎</span>
                                            <span><span style="font-size:9px;font-weight:800;color:#06b6d4;display:block;">Anexos</span>Documentos</span>
                                        </div>
                                    </div>

                                    <div id="mn-panels-container">
                                        <div id="panel-t1" style="display:block;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">📖 1. Glosario — Términos del Sistema de Control Interno</div>
                                                <div class="mn-glos-grid">
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Ambiente de control</div>
                                                        <div class="mn-glos-def">Base del SCI. Incluye valores éticos, estructura organizacional, estilo de liderazgo y compromiso de los colaboradores.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Apetito de riesgo</div>
                                                        <div class="mn-glos-def">Nivel de riesgo que la organización está dispuesta a aceptar en la búsqueda de sus objetivos estratégicos y creación de valor.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Auditoría</div>
                                                        <div class="mn-glos-def">Proceso de verificación y evaluación independiente de los controles, riesgos y operaciones para garantizar su funcionamiento adecuado.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Autocontrol</div>
                                                        <div class="mn-glos-def">Capacidad de cada colaborador para evaluar y mejorar continuamente su desempeño en las tareas asignadas.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Autorregulación</div>
                                                        <div class="mn-glos-def">Aptitud de la organización para mantener y ajustar su SCI mediante normas, políticas y procedimientos propios.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Autogestión</div>
                                                        <div class="mn-glos-def">Facultad de la empresa para tomar decisiones sobre la mejora continua del SCI y su sostenibilidad.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Código de Ética</div>
                                                        <div class="mn-glos-def">Documento institucional que establece principios y valores que deben guiar el comportamiento de todos los miembros de la organización.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Control</div>
                                                        <div class="mn-glos-def">Actividad diseñada e implementada para gestionar riesgos y facilitar el logro de los objetivos. Debe ser específica, periódica y adaptable.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">COSO</div>
                                                        <div class="mn-glos-def">Committee of Sponsoring Organizations of the Treadway Commission. Modelo de referencia internacional para implementación de sistemas de control interno.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Control Interno</div>
                                                        <div class="mn-glos-def">Conjunto de normas, políticas, procesos y estructuras diseñadas para proporcionar seguridad razonable sobre el logro de los objetivos organizacionales.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Efectividad</div>
                                                        <div class="mn-glos-def">Grado en que las actividades logran los resultados esperados, considerando el cumplimiento de objetivos y el uso eficiente de los recursos.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Eficiencia</div>
                                                        <div class="mn-glos-def">Uso óptimo de los recursos disponibles para alcanzar los resultados deseados.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Eficacia</div>
                                                        <div class="mn-glos-def">Capacidad para alcanzar los objetivos propuestos de manera oportuna y con calidad.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Gestión del riesgo</div>
                                                        <div class="mn-glos-def">Proceso sistemático de identificar, analizar, evaluar, monitorear y controlar riesgos que puedan afectar los objetivos de la empresa.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Impacto</div>
                                                        <div class="mn-glos-def">Consecuencia de un evento, expresado cualitativa o cuantitativamente, que puede manifestarse como pérdida, daño o desventaja para la organización.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Matriz de riesgos</div>
                                                        <div class="mn-glos-def">Herramienta que permite visualizar y analizar los riesgos de un proceso, considerando probabilidad e impacto, junto con los controles existentes.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Monitoreo</div>
                                                        <div class="mn-glos-def">Supervisión constante del desempeño del SCI mediante indicadores, auditorías y cuestionarios.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Probabilidad</div>
                                                        <div class="mn-glos-def">Posibilidad de ocurrencia de un evento de riesgo. Se determina mediante enfoques cualitativos o cuantitativos (datos históricos y modelos estadísticos).</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Riesgo</div>
                                                        <div class="mn-glos-def">Posibilidad de que un evento afecte negativamente el logro de los objetivos institucionales.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Sistema de Control Interno</div>
                                                        <div class="mn-glos-def">Estructura integrada por políticas, procesos, principios y herramientas orientadas a garantizar el cumplimiento de los objetivos empresariales y la gestión de riesgos.</div>
                                                    </div>
                                                    <div class="mn-glos-item">
                                                        <div class="mn-glos-term">Transparencia</div>
                                                        <div class="mn-glos-def">Práctica organizacional que promueve la rendición de cuentas y la accesibilidad de la información relevante para todos los grupos de interés.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t2" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">📝 2. Introducción</div>
                                                <div style="font-size:12px;color:#1A2826;line-height:1.7;font-weight:600;margin-bottom:14px;">El Control Interno es un sistema integral que, de manera articulada, funciona como una herramienta esencial de gestión para el Gobierno Corporativo. Este sistema tiene como finalidad apoyar el logro de los objetivos organizacionales, alineados con la estrategia corporativa. A través del Control Interno, la empresa puede evaluar y asegurar la eficiencia y eficacia de sus procesos, promoviendo el uso responsable de los recursos, la mejora continua, la gestión adecuada de los riesgos y el cumplimiento de los lineamientos legales y normativos vigentes.</div>
                                                <div style="background:#f1f5f9;border-radius:8px;padding:13px 15px;margin-bottom:14px;">
                                                    <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:8px;">En Naples Prime S.A.S. CI, el SCI se estructura bajo el modelo COSO con 5 componentes esenciales:</div>
                                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;">
                                                        <div style="background:#fff;border-radius:6px;padding:8px 11px;border-left:3px solid #0f172a;font-size:11px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:7px;"><span>1️⃣</span>Ambiente de Control</div>
                                                        <div style="background:#fff;border-radius:6px;padding:8px 11px;border-left:3px solid #0f172a;font-size:11px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:7px;"><span>2️⃣</span>Evaluación del Riesgo</div>
                                                        <div style="background:#fff;border-radius:6px;padding:8px 11px;border-left:3px solid #0f172a;font-size:11px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:7px;"><span>3️⃣</span>Actividades de Control</div>
                                                        <div style="background:#fff;border-radius:6px;padding:8px 11px;border-left:3px solid #0f172a;font-size:11px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:7px;"><span>4️⃣</span>Información y Comunicación</div>
                                                        <div style="background:#fff;border-radius:6px;padding:8px 11px;border-left:3px solid #0f172a;font-size:11px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:7px;grid-column:1/-1;"><span>5️⃣</span>Supervisión y Seguimiento del Sistema de Control</div>
                                                    </div>
                                                </div>
                                                <div style="font-size:11.5px;color:#4A6260;line-height:1.65;font-weight:600;">El presente manual promueve el compromiso organizacional por parte de todos los colaboradores involucrados en la implementación del Sistema de Control Interno. Su correcta aplicación contribuye a generar <strong style="color:#0f172a;">confiabilidad, transparencia y calidad en la información</strong>, elementos clave para todos los usuarios internos y externos que interactúan con la empresa.</div>
                                            </div>
                                        </div>

                                        <div id="panel-t3" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">🏢 3. Generalidades</div>
                                                <div class="mn-sep"></div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:6px;">3.1 Definición del Control Interno</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:13px;">El Control Interno es un sistema conformado por procesos, normas, políticas, principios y procedimientos implementados por la administración de la empresa. Su propósito es garantizar información razonable, confiable, transparente y eficiente para el logro de los objetivos organizacionales, en coherencia con la estrategia corporativa y las políticas internas.</div>
                                                <div class="mn-sep"></div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:6px;">3.2 Importancia en la Empresa</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:13px;">El control interno permite establecer medidas preventivas y correctivas que minimicen los diferentes riesgos que puedan comprometer la estabilidad y continuidad del negocio. En la actualidad, los gobiernos corporativos no solo se enfocan en ampliar su participación en el mercado, sino también en asegurar la sostenibilidad de la empresa.</div>
                                                <div class="mn-sep"></div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:8px;">3.3 Marco Normativo</div>
                                                <div class="mn-norm">
                                                    <div class="mn-norm-dot"></div>
                                                    <div class="mn-norm-body"><strong>Decreto Único Reglamentario 2420 de 2015</strong> — Arts. 1.2.1.2. y 1.2.1.5. y sus decretos modificatorios. Verifica que los actos de los administradores se ajusten a los estatutos sociales y a las decisiones de la Asamblea y Junta Directiva.</div>
                                                </div>
                                                <div class="mn-norm">
                                                    <div class="mn-norm-dot"></div>
                                                    <div class="mn-norm-body"><strong>Código de Comercio — Art. 209, num. 1° y 3°</strong> — Medidas de control interno orientadas a la conservación y custodia de los bienes de la compañía y de terceros bajo su administración.</div>
                                                </div>
                                                <div class="mn-norm">
                                                    <div class="mn-norm-dot"></div>
                                                    <div class="mn-norm-body"><strong>Guía de Buenas Prácticas de Gobierno Corporativo</strong> — Capítulo VI: control y administración de riesgos. Capítulo VII: sostenibilidad como principio transversal de la gestión empresarial.</div>
                                                </div>
                                                <div class="mn-sep"></div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:6px;">3.4 Alcance del Control Interno</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:13px;">El control interno abarca la identificación, evaluación, prevención, control y monitoreo de riesgos que puedan afectar los objetivos institucionales en metas estratégicas, operativas, financieras y normativas.</div>
                                                <div class="mn-sep"></div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:6px;">3.5 Contribución a la Cultura Organizacional</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;">Más allá de ser un mecanismo de control, el sistema fomenta una cultura organizacional orientada a la anticipación, mitigación y gestión efectiva de situaciones adversas. Se consolida como un componente estratégico para garantizar la transparencia, la sostenibilidad y la responsabilidad corporativa.</div>
                                            </div>
                                        </div>

                                        <div id="panel-t4" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">🎯 4. Objetivo General y 5. Objetivos Específicos</div>
                                                <div class="mn-obj-main">
                                                    <div class="mn-obj-lbl">Objetivo General — Naples Prime S.A.S. C.I.</div>
                                                    <div class="mn-obj-txt">Implementar un Sistema de Control Interno que garantice la gestión eficiente y confiable de la información, el estricto cumplimiento de la normativa vigente y la protección de los intereses de la empresa. De igual manera, fortalecer una cultura organizacional orientada a la prevención, la responsabilidad y la transparencia, asegurando la aplicación de estrategias efectivas para la evaluación permanente y la mejora continua de los procesos.</div>
                                                </div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin:12px 0 8px;">Objetivos Específicos</div>
                                                <div class="mn-obj-esp">
                                                    <div class="mn-obj-num">1</div>
                                                    <div class="mn-obj-body"><strong>Información de calidad:</strong> Proporcionar una herramienta que permita generar información de calidad, confiable y oportuna para todos los usuarios, facilitando la evaluación de riesgos y la implementación de controles y acciones correctivas.</div>
                                                </div>
                                                <div class="mn-obj-esp">
                                                    <div class="mn-obj-num">2</div>
                                                    <div class="mn-obj-body"><strong>Apoyo a la gerencia:</strong> Apoyar a la gerencia en la protección de los intereses de la empresa, mediante el fortalecimiento del control interno y la supervisión de los procesos clave.</div>
                                                </div>
                                                <div class="mn-obj-esp">
                                                    <div class="mn-obj-num">3</div>
                                                    <div class="mn-obj-body"><strong>Cumplimiento normativo:</strong> Verificar el cumplimiento de la normatividad vigente en los diferentes departamentos de la empresa, garantizando la alineación con los requisitos legales y corporativos.</div>
                                                </div>
                                                <div class="mn-obj-esp">
                                                    <div class="mn-obj-num">4</div>
                                                    <div class="mn-obj-body"><strong>Socialización del Manual SCI:</strong> Socializar el Manual del Sistema de Control Interno con todos los colaboradores de Naples Prime S.A.S. CI, promoviendo su conocimiento, apropiación y cumplimiento.</div>
                                                </div>
                                                <div class="mn-obj-esp">
                                                    <div class="mn-obj-num">5</div>
                                                    <div class="mn-obj-body"><strong>Cultura preventiva:</strong> Fomentar una cultura organizacional con enfoque preventivo, que asegure la ejecución efectiva de las estrategias definidas y contribuya a la mejora continua.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t5" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">📐 6. Alcance del Sistema de Control Interno</div>
                                                <div style="background:#f1f5f9;border-radius:8px;padding:14px 16px;margin-bottom:12px;border-left:4px solid #0f172a;">
                                                    <div style="font-size:12px;color:#1A2826;line-height:1.7;font-weight:600;">El Sistema de Control Interno tiene como alcance proporcionar una herramienta efectiva para la gestión de riesgos, mediante su <strong style="color:#0f172a;">identificación, medición, evaluación y control</strong> en cada uno de los procesos de la empresa, contribuyendo así al cumplimiento de los objetivos organizacionales.</div>
                                                </div>
                                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:9px;margin-top:4px;">
                                                    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:7px;padding:11px 13px;border-left:3px solid #0f172a;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Metas estratégicas</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Alineación con los objetivos corporativos de largo plazo.</div>
                                                    </div>
                                                    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:7px;padding:11px 13px;border-left:3px solid #06b6d4;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Metas operativas</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Eficiencia y eficacia en la ejecución de los procesos.</div>
                                                    </div>
                                                    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:7px;padding:11px 13px;border-left:3px solid #0f172a;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Metas financieras</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Confiabilidad de la información y control del riesgo financiero.</div>
                                                    </div>
                                                    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:7px;padding:11px 13px;border-left:3px solid #06b6d4;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Metas normativas</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Cumplimiento de la legislación vigente y normativas aplicables.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t6" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">⚖️ 7. Principios del Sistema de Control Interno</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:14px;">El Gobierno Corporativo promueve una cultura organizacional basada en la responsabilidad y el compromiso de todos los colaboradores, con el fin de alcanzar los objetivos institucionales y contribuir al crecimiento económico, social y sostenible de la organización.</div>
                                                <div class="mn-princ-grid">
                                                    <div class="mn-princ">
                                                        <div class="mn-princ-n">1</div>
                                                        <div class="mn-princ-t">Autocontrol</div>
                                                        <div class="mn-princ-b">Cada colaborador debe evaluar y supervisar sus propias funciones, identificar oportunidades de mejora y ejecutar acciones correctivas de manera proactiva.</div>
                                                    </div>
                                                    <div class="mn-princ">
                                                        <div class="mn-princ-n">2</div>
                                                        <div class="mn-princ-t">Autorregulación</div>
                                                        <div class="mn-princ-b">La entidad debe contar con herramientas, políticas y procedimientos para implementar, mantener y mejorar de forma continua el SCI, alineado con los objetivos estratégicos.</div>
                                                    </div>
                                                    <div class="mn-princ">
                                                        <div class="mn-princ-n">3</div>
                                                        <div class="mn-princ-t">Autogestión</div>
                                                        <div class="mn-princ-b">La organización debe evaluar permanentemente la efectividad del SCI y tomar decisiones oportunas que garanticen su eficiencia, adaptabilidad y sostenibilidad.</div>
                                                    </div>
                                                    <div class="mn-princ">
                                                        <div class="mn-princ-n">4</div>
                                                        <div class="mn-princ-t">Transparencia y Ética</div>
                                                        <div class="mn-princ-b">Todas las operaciones y actuaciones deben regirse por principios de transparencia, integridad y ética, fortaleciendo la confianza de los grupos de interés.</div>
                                                    </div>
                                                    <div class="mn-princ">
                                                        <div class="mn-princ-n">5</div>
                                                        <div class="mn-princ-t">Eficiencia y Eficacia</div>
                                                        <div class="mn-princ-b">La empresa debe orientar sus esfuerzos al logro de los resultados propuestos, maximizando el uso de los recursos y garantizando el cumplimiento de las metas con calidad.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t7" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">✅ 8. Efectividad del Sistema de Control Interno</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:14px;">La efectividad del Sistema de Control Interno depende de la adecuada identificación y evaluación de los riesgos, del diseño de políticas y procedimientos coherentes, de la concientización del personal involucrado y del monitoreo permanente de las actividades. Para garantizarlo, la compañía desarrolla las siguientes acciones:</div>
                                                <div class="mn-efec-grid">
                                                    <div class="mn-efec">
                                                        <div class="mn-efec-icon">🔍</div>
                                                        <div class="mn-efec-t">Monitoreo Sistemático</div>
                                                        <div class="mn-efec-b">Aplicar de manera continua técnicas de evaluación que permitan verificar la efectividad de los controles en los distintos procesos, identificando oportunidades de mejora.</div>
                                                    </div>
                                                    <div class="mn-efec">
                                                        <div class="mn-efec-icon">📊</div>
                                                        <div class="mn-efec-t">Gestión de Riesgos Financieros</div>
                                                        <div class="mn-efec-b">Identificar y valorar los riesgos de incorrección material en los estados financieros, ya sea por fraude o error, mediante técnicas de auditoría basadas en evidencia suficiente.</div>
                                                    </div>
                                                    <div class="mn-efec">
                                                        <div class="mn-efec-icon">📢</div>
                                                        <div class="mn-efec-t">Comunicación de Resultados</div>
                                                        <div class="mn-efec-b">Informar oportunamente a la Administración sobre los hallazgos derivados de las auditorías y sobre el funcionamiento del SCI, asegurando la toma de decisiones correctivas.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t8" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">📜 9. Política del Sistema de Control Interno</div>
                                                <div class="mn-pol">
                                                    <div class="mn-pol-lbl">Política Institucional — Naples Prime S.A.S. C.I.</div>
                                                    <div class="mn-pol-txt">NAPLES PRIME S.A.S. CI incorpora el presente manual con el propósito de establecer los lineamientos para el funcionamiento del Sistema de Control Interno adoptado. Este sistema busca garantizar información confiable y transparente para todos los usuarios, facilitando el cumplimiento de los objetivos y de la estrategia de Gobierno Corporativo. Asimismo, asegura el acatamiento de la normatividad legal vigente en el desarrollo de la actividad y promueve una adecuada gestión de los riesgos.</div>
                                                </div>
                                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:9px;margin-top:4px;">
                                                    <div style="background:#f1f5f9;border-radius:7px;padding:11px 13px;border-left:3px solid #0f172a;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Información confiable</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Garantizar información transparente y oportuna para todos los usuarios internos y externos.</div>
                                                    </div>
                                                    <div style="background:#f1f5f9;border-radius:7px;padding:11px 13px;border-left:3px solid #06b6d4;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Cumplimiento normativo</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Asegurar el acatamiento de la normatividad legal vigente en el desarrollo de la actividad.</div>
                                                    </div>
                                                    <div style="background:#f1f5f9;border-radius:7px;padding:11px 13px;border-left:3px solid #0f172a;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Gestión de riesgos</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Promover una adecuada gestión de los riesgos corporativos que puedan afectar los objetivos estratégicos.</div>
                                                    </div>
                                                    <div style="background:#f1f5f9;border-radius:7px;padding:11px 13px;border-left:3px solid #06b6d4;">
                                                        <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:4px;">Gobierno Corporativo</div>
                                                        <div style="font-size:10.5px;color:#4A6260;font-weight:600;">Facilitar el cumplimiento de los objetivos y de la estrategia de Gobierno Corporativo.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t9" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">👥 10. Funciones y Responsabilidades frente al Control Interno</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:12px;">El Control Interno es una responsabilidad primaria de la administración de la empresa, la cual puede designar un encargado específico para mantener y fortalecer el sistema implementado.</div>
                                                <div class="mn-rol">
                                                    <div class="mn-rol-t"><span>🏢</span>Administración / Representante Legal / Gerencia</div>
                                                    <div class="mn-rol-b">Responsabilidad primaria del SCI. Entre sus obligaciones: impulsar la mejora continua, garantizar el cumplimiento de los objetivos estratégicos y asegurar la adopción de las acciones correctivas necesarias. Evalúa los resultados de los controles junto con los líderes de proceso y los informes de auditoría, con el propósito de aplicar las mejoras pertinentes al sistema.</div>
                                                </div>
                                                <div class="mn-rol">
                                                    <div class="mn-rol-t"><span>🔎</span>Revisor Fiscal y Auditoría Externa</div>
                                                    <div class="mn-rol-b">Ejercen la función de evaluar la eficacia del Sistema de Control Interno, verificando su cumplimiento y emitiendo recomendaciones que fortalezcan su efectividad. Aportan una visión independiente sobre el cumplimiento normativo y comunican oportunamente cualquier debilidad o riesgo en los componentes financieros, de gestión, control o cumplimiento.</div>
                                                </div>
                                                <div class="mn-rol">
                                                    <div class="mn-rol-t"><span>👥</span>Colaboradores y Empleados</div>
                                                    <div class="mn-rol-b">Deben aplicar lo dispuesto en el Manual del Sistema de Control Interno, contribuyendo a la eficiencia y eficacia del sistema mediante un trabajo conjunto, armónico e integral. Participan activamente en la gestión de los riesgos identificados, en la protección de los recursos y en la defensa de los intereses de la organización.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t10" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">🏛 11. Componentes del Sistema de Control Interno — Marco COSO</div>
                                                <div class="mn-coso">
                                                    <div class="mn-coso-hdr mn-open" onclick="mnCoso(this)">
                                                        <div class="mn-coso-n">1</div>
                                                        <div class="mn-coso-t">11.1 Ambiente de Control</div>
                                                        <div class="mn-coso-badge">Base fundamental del SCI</div>
                                                        <div class="mn-coso-arr mn-open">▶</div>
                                                    </div>
                                                    <div class="mn-coso-body mn-open">
                                                        <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:11px;">La empresa fomenta un entorno organizacional sustentado en valores éticos, integridad y responsabilidad, presentes en todos los niveles jerárquicos.</div>
                                                        <div class="mn-coso-sub">📜 Código de Ética — Aprobado el 28 de febrero de 2022</div>
                                                        <div style="font-size:11px;color:#4A6260;font-weight:600;line-height:1.6;margin-bottom:11px;">Establece los principios, valores y normas de conducta que guían el actuar de todos sus miembros. Basado en la integridad y el respeto por la normatividad vigente, busca garantizar el buen funcionamiento de la organización y preservar la reputación corporativa.</div>
                                                        <div class="mn-coso-sub">💎 Valores Corporativos</div>
                                                        <div style="margin-bottom:12px;"><span class="mn-valor">HONESTIDAD</span><span class="mn-valor">COMPROMISO</span><span class="mn-valor">CALIDAD</span><span class="mn-valor">COMPETITIVIDAD</span><span class="mn-valor">RESPONSABILIDAD SOCIAL</span></div>
                                                        <div class="mn-coso-sub">📋 Misión</div>
                                                        <div style="font-size:11px;color:#4A6260;font-weight:600;line-height:1.6;margin-bottom:11px;background:#f1f5f9;border-radius:6px;padding:9px 11px;">Somos una comercializadora de materias primas y productos colombianos en el mercado internacional, especializada en detectar y generar negocios sostenibles y de larga duración, contribuyendo al desarrollo social y económico de nuestro país.</div>
                                                        <div class="mn-coso-sub">🔭 Visión</div>
                                                        <div style="font-size:11px;color:#4A6260;font-weight:600;line-height:1.6;background:#f1f5f9;border-radius:6px;padding:9px 11px;">Seremos líderes activos en la oferta al mercado de un portafolio altamente diversificado compuesto por productos nacionales e internacionales cuidadosamente seleccionados que compitan en el entorno global por su calidad.</div>
                                                    </div>
                                                </div>
                                                <div class="mn-coso">
                                                    <div class="mn-coso-hdr" onclick="mnCoso(this)">
                                                        <div class="mn-coso-n">2</div>
                                                        <div class="mn-coso-t">11.2 Evaluación del Riesgo</div>
                                                        <div class="mn-coso-badge">Metodología COSO · Matriz de Riesgos</div>
                                                        <div class="mn-coso-arr">▶</div>
                                                    </div>
                                                    <div class="mn-coso-body">
                                                        <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:11px;">Se ha diseñado una matriz de riesgos para cada proceso, con el fin de identificar, analizar, evaluar, monitorear y gestionar los riesgos de manera efectiva. La herramienta clasifica los riesgos según su nivel de impacto y probabilidad.</div>
                                                        <div class="mn-coso-sub">⚠ 5 Factores de Riesgo Identificados</div>
                                                        <div class="mn-factor"><span>⚙️</span>1. Riesgos Operacionales</div>
                                                        <div class="mn-factor"><span>🚨</span>2. Riesgos de Fraude</div>
                                                        <div class="mn-factor"><span>💰</span>3. Riesgos Financieros</div>
                                                        <div class="mn-factor"><span>📜</span>4. Riesgos de Cumplimiento</div>
                                                        <div class="mn-factor"><span>🔒</span>5. Riesgo de Seguridad de la Información</div>
                                                    </div>
                                                </div>
                                                <div class="mn-coso">
                                                    <div class="mn-coso-hdr" onclick="mnCoso(this)">
                                                        <div class="mn-coso-n">3</div>
                                                        <div class="mn-coso-t">11.3 Actividades de Control</div>
                                                        <div class="mn-coso-badge">Políticas · Procedimientos · Estrategias</div>
                                                        <div class="mn-coso-arr">▶</div>
                                                    </div>
                                                    <div class="mn-coso-body">
                                                        <div class="mn-factor"><span>📋</span><strong>Manual de Funciones y Procedimientos:</strong> Define lineamientos y políticas específicas para cada proceso con formatos y mecanismos de control.</div>
                                                        <div class="mn-factor"><span>📅</span><strong>Calendario de obligatorio cumplimiento:</strong> Con recordatorios y alertas que previenen multas o sanciones.</div>
                                                        <div class="mn-factor"><span>✅</span><strong>Evaluación periódica de controles:</strong> Garantiza adecuada aplicación y genera oportunidades de mejora continua.</div>
                                                    </div>
                                                </div>
                                                <div class="mn-coso">
                                                    <div class="mn-coso-hdr" onclick="mnCoso(this)">
                                                        <div class="mn-coso-n">4</div>
                                                        <div class="mn-coso-t">11.4 Información y Comunicación</div>
                                                        <div class="mn-coso-badge">Canales · TI · Manuales institucionales</div>
                                                        <div class="mn-coso-arr">▶</div>
                                                    </div>
                                                    <div class="mn-coso-body">
                                                        <div class="mn-factor"><span>📋</span>Manual SAGRILAFT — Riesgo de Lavado de Activos y Financiación del Terrorismo</div>
                                                        <div class="mn-factor"><span>📋</span>Manual del Sistema de Control Interno (SCI) — MA-DE-01</div>
                                                        <div class="mn-factor"><span>🦺</span>Sistema de Gestión de Seguridad y Salud en el Trabajo (SG-SST)</div>
                                                    </div>
                                                </div>
                                                <div class="mn-coso">
                                                    <div class="mn-coso-hdr" onclick="mnCoso(this)">
                                                        <div class="mn-coso-n">5</div>
                                                        <div class="mn-coso-t">11.5 Supervisión y Seguimiento del SCI</div>
                                                        <div class="mn-coso-badge">4 Herramientas de monitoreo continuo</div>
                                                        <div class="mn-coso-arr">▶</div>
                                                    </div>
                                                    <div class="mn-coso-body">
                                                        <div class="mn-herr">
                                                            <div class="mn-herr-n">01</div>
                                                            <div class="mn-herr-t">Manual SCI</div>
                                                            <div class="mn-herr-b">Se divulga a los colaboradores mediante capacitaciones, dejando constancia de su realización.</div>
                                                        </div>
                                                        <div class="mn-herr">
                                                            <div class="mn-herr-n">02</div>
                                                            <div class="mn-herr-t">Formularios y Cuestionarios de Control</div>
                                                            <div class="mn-herr-b">Formulario Mensual de Resumen de Actividades + Cuestionario de Control Interno por Proceso.</div>
                                                        </div>
                                                        <div class="mn-herr">
                                                            <div class="mn-herr-n">03</div>
                                                            <div class="mn-herr-t">Informe de Revisoría Fiscal</div>
                                                            <div class="mn-herr-b">Visión independiente sobre el cumplimiento normativo y detección de debilidades del sistema.</div>
                                                        </div>
                                                        <div class="mn-herr">
                                                            <div class="mn-herr-n">04</div>
                                                            <div class="mn-herr-t">Informe de Auditoría Externa</div>
                                                            <div class="mn-herr-b">Observaciones y recomendaciones que permiten prevenir riesgos y contribuir a la mejora continua.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t11" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">🗂 Estructura Organizacional — Naples Prime S.A.S. C.I.</div>
                                                <div class="mn-org">
                                                    <div class="mn-org-top">
                                                        <div class="mn-org-box dark" style="min-width:180px;">ASAMBLEA DE ACCIONISTAS</div>
                                                        <div class="mn-org-line"></div>
                                                        <div style="display:flex;gap:14px;align-items:flex-start;justify-content:center;">
                                                            <div style="display:flex;flex-direction:column;align-items:center;gap:3px;">
                                                                <div class="mn-org-box" style="font-size:9.5px;min-width:110px;">PRESIDENTE<br><span style="font-weight:400;opacity:.85;">Álvaro Mejía M.</span></div>
                                                            </div>
                                                            <div style="display:flex;flex-direction:column;align-items:center;gap:3px;">
                                                                <div class="mn-org-box med" style="min-width:150px;font-size:10px;">JUNTA DIRECTIVA</div>
                                                                <div class="mn-org-box cargo" style="font-size:9px;">Secretario: Luis F. Ospina<br>Tesorero: Juan M. Tahurt</div>
                                                            </div>
                                                            <div style="display:flex;flex-direction:column;align-items:center;gap:3px;">
                                                                <div class="mn-org-box" style="font-size:9.5px;min-width:110px;">REVISORÍA FISCAL<br><span style="font-weight:400;opacity:.85;">Olga Reyes</span></div>
                                                                <div class="mn-org-box cargo" style="font-size:9px;">Auditores: Carlos Alvarado<br>Auditores SAG</div>
                                                            </div>
                                                        </div>
                                                        <div class="mn-org-line"></div>
                                                        <div class="mn-org-box" style="min-width:190px;font-size:10px;">REPRESENTANTE LEGAL<br><span style="font-weight:400;opacity:.85;">Principal: Mauricio Reyes<br>Suplente: Ramses Prieto</span></div>
                                                        <div class="mn-org-line"></div>
                                                        <div class="mn-org-box light" style="min-width:160px;font-size:10px;">OFICIAL DE CUMPLIMIENTO<br>Helen Castellanos</div>
                                                        <div class="mn-org-line"></div>
                                                    </div>
                                                    <div style="font-size:9.5px;font-weight:800;color:#0f172a;text-align:center;margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px;">7 Direcciones — Estructura Departamental</div>
                                                    <div class="mn-org-dirs">
                                                        <div>
                                                            <div class="mn-org-dir">DRC.001<br>Dir. Riesgo y Cumplimiento<br><span style="font-weight:400;opacity:.85;">Helen Castellanos</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Analista</div>
                                                                <div class="mn-org-cargo">Validación de datos</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mn-org-dir">DJUR.002<br>Dir. Jurídica<br><span style="font-weight:400;opacity:.85;">Ramses Prieto</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Asistente Jurídico · Kathya Velasco</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mn-org-dir">GH.003<br>Dir. Gestión Humana<br><span style="font-weight:400;opacity:.85;">Ramses Prieto</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Coord. SG-SST · Diana Casas</div>
                                                                <div class="mn-org-cargo">Asistente · Kathya Velasco</div>
                                                                <div class="mn-org-cargo">Coord. Seguridad · Gustavo R.</div>
                                                                <div class="mn-org-cargo">Conductor · Luis Zapata</div>
                                                                <div class="mn-org-cargo">Serv. Grls · Marta Ramírez</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mn-org-dir">DFC.004<br>Dir. Financiero y Contable<br><span style="font-weight:400;opacity:.85;">Katty Mongui</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Tesorera · Carolina David</div>
                                                                <div class="mn-org-cargo">Asistente · Asistentes Contables</div>
                                                                <div class="mn-org-cargo">Auxiliar · Carolina Lora</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mn-org-dir">CRL.005<br>Dir. Comercial<br><span style="font-weight:400;opacity:.85;">Felipe Reyes · Ana Arroyave</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Trader · Camilo Bichónico</div>
                                                                <div class="mn-org-cargo">Auxiliar Trader · Johan H.</div>
                                                                <div class="mn-org-cargo">Coord. Aduanas · Jairo Ramos</div>
                                                                <div class="mn-org-cargo">Coord. Lab. · Camilo Castib.</div>
                                                                <div class="mn-org-cargo">Analista · Santiago B.</div>
                                                                <div class="mn-org-cargo">Asist. Admón. · Laura E. / Nicolás R.</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mn-org-dir">ASG.006<br>Dir. TI y Sostenibilidad<br><span style="font-weight:400;opacity:.85;">Fabio Bayona</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Director TI y Sostenibilidad</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mn-org-dir">DOLN.007<br>Dir. Otras Líneas de Negocio<br><span style="font-weight:400;opacity:.85;">Diana Casas</span></div>
                                                            <div class="mn-org-cargos">
                                                                <div class="mn-org-cargo">Director Otras Líneas</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="panel-t12" style="display:none;">

                                            <div class="mn-card">
                                                <div class="mn-card-title">📎 Anexos — Documentos de Referencia y Control</div>
                                                <div style="font-size:11.5px;color:#1A2826;line-height:1.65;font-weight:600;margin-bottom:13px;">Los siguientes anexos complementan y soportan el contenido del Manual del Sistema de Control Interno. Su función es brindar herramientas prácticas y documentos de referencia para la aplicación, seguimiento y mejora del sistema.</div>
                                                <div class="mn-anx-grid" style="margin-bottom:16px;">
                                                    <div class="mn-anx">
                                                        <div class="mn-anx-icon">📊</div>
                                                        <div class="mn-anx-t">Anexo 1 · Matriz de Análisis de Riesgos por Proceso</div>
                                                        <div class="mn-anx-b">Consolida los eventos identificados en los distintos procesos de la compañía, con su respectiva probabilidad de ocurrencia, nivel de impacto y controles asociados.</div>
                                                        <div class="mn-anx-code">Formato Excel independiente</div>
                                                    </div>
                                                    <div class="mn-anx">
                                                        <div class="mn-anx-icon">📋</div>
                                                        <div class="mn-anx-t">Anexo 2 · Listado de Cargos con Manual de Procesos y Procedimientos</div>
                                                        <div class="mn-anx-b">Detalle de los cargos de la organización junto con los procesos y procedimientos del Manual de Funciones.</div>
                                                        <div class="mn-anx-code">DRC.001 · DJUR.002 · GH.003 · DFC.004 · CRL.005 · ASG.006 · DOLN.007</div>
                                                    </div>
                                                    <div class="mn-anx">
                                                        <div class="mn-anx-icon">📁</div>
                                                        <div class="mn-anx-t">Anexo 3 · Maestro de Documentos y Registros</div>
                                                        <div class="mn-anx-b">Inventario de documentos vigentes en la compañía, con información sobre denominación, código, versión, fecha de emisión y responsables.</div>
                                                        <div class="mn-anx-code">F-GSST-03 · Formato PDF independiente</div>
                                                    </div>
                                                </div>
                                                <div class="mn-sep"></div>
                                                <div style="font-size:11px;font-weight:800;color:#0f172a;margin-bottom:8px;">Control de Actualizaciones</div>
                                                <table class="mn-ver-table" style="margin-bottom:12px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Versión</th>
                                                            <th>Descripción del Cambio</th>
                                                            <th>Fecha</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-weight:800;color:#0f172a;">01</td>
                                                            <td>Versión Inicial del Manual del Sistema de Control Interno</td>
                                                            <td>25/09/2025</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="mn-conf">
                                                    <div class="mn-conf-icon">🔒</div>
                                                    <div class="mn-conf-txt">Este documento fue elaborado por <strong>Valoración Inversiones S.A.S., Nora A. Mora Barbosa y Daniela Mora Barbosa</strong> para NAPLES PRIME S.A.S. C.I. Su gestión y control estarán a cargo del área responsable de la administración documental. La información aquí contenida es de carácter <strong>confidencial</strong>, por lo cual se prohíbe su reproducción total o parcial y su divulgación a terceros ajenos a NAPLES PRIME S.A.S. C.I.</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div><!-- /sManual -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

        <script>
            function mnTab(id) {
                var tabs = ['t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12'];
                for (var i = 0; i < tabs.length; i++) {
                    var p = document.getElementById('panel-' + tabs[i]);
                    var b = document.getElementById('btn-' + tabs[i]);
                    if (p) p.style.display = 'none';
                    if (b) {
                        b.style.background = '';
                        b.style.color = '#3D4543';
                        b.style.fontWeight = '600';
                        b.style.borderLeft = '';
                    }
                }
                var ap = document.getElementById('panel-' + id);
                var ab = document.getElementById('btn-' + id);
                if (ap) ap.style.display = 'block';
                if (ab) {
                    ab.style.background = '#f1f5f9';
                    ab.style.color = '#0f172a';
                    ab.style.fontWeight = '800';
                    ab.style.borderLeft = '3px solid #0f172a';
                }
            }

            function mnCoso(hdr) {
                var body = hdr.nextElementSibling;
                var arr = hdr.querySelector('.mn-coso-arr');
                var isOpen = body.classList.contains('mn-open');
                document.querySelectorAll('#p-coso .mn-coso-body').forEach(function(b) {
                    b.classList.remove('mn-open');
                });
                document.querySelectorAll('#p-coso .mn-coso-hdr').forEach(function(h) {
                    h.classList.remove('mn-open');
                });
                document.querySelectorAll('#p-coso .mn-coso-arr').forEach(function(a) {
                    a.classList.remove('mn-open');
                });
                if (!isOpen) {
                    body.classList.add('mn-open');
                    hdr.classList.add('mn-open');
                    arr.classList.add('mn-open');
                }
            }

            function openMinModal() {
                document.getElementById('modalMineria').classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeMinModal() {
                document.getElementById('modalMineria').classList.remove('open');
                document.body.style.overflow = '';
            }
            document.getElementById('modalMineria').addEventListener('click', function(e) {
                if (e.target === this) closeMinModal();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeMinModal();
            });
        </script>
        <script>
            function showSection(id) {
                document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
                document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
                const el = document.getElementById(id);
                if (el) el.classList.add('active');
                document.querySelectorAll('.nav-tab').forEach(t => {
                    const oc = t.getAttribute('onclick') || '';
                    if (oc.includes("'" + id + "'")) t.classList.add('active');
                });
                if (id === 's1') buildChart();
                if (id === 's2') buildDesc('all');
                if (id === 's4') buildThermal('all');
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            let chartBuilt = false;

            function buildChart() {
                if (chartBuilt) return;
                chartBuilt = true;
                new Chart(document.getElementById('chartProb'), {
                    type: 'bar',
                    data: {
                        labels: ['Dir. Riesgo/Cumpl.', 'Dir. Jurídica', 'Dir. G. Humana', 'Dir. Fin./Contable', 'Dir. Comercial', 'Dir. TI/Sostenib.', 'Otras Líneas'],
                        datasets: [{
                            label: 'Cantidad de riesgos',
                            data: [8, 4, 6, 15, 12, 9, 3],
                            backgroundColor: ['#0F52A0', '#185FA5', '#378ADD', '#0A3A74', '#C0392B', '#E67E22', '#85B7EB'],
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 2
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 10
                                    },
                                    maxRotation: 30
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            const RISKS = [{
                    code: 'RSCI-1',
                    proc: 'DRC',
                    desc: 'Vinculación de contrapartes relacionados con actividades LAFT.',
                    cause: 'Fallas en la debida diligencia relacionada con contrapartes.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 3,
                    impact: 5,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-2',
                    proc: 'DRC',
                    desc: 'Operaciones realizadas en efectivo.',
                    cause: 'Incumplimiento en políticas de tesorería y de Sagrilaft.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 1,
                    impact: 4,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-3',
                    proc: 'DRC',
                    desc: 'Incumplimiento en normatividad legal vigente de obligatorio cumplimiento (Circular Externa 100-000016).',
                    cause: 'Falta de conocimiento y competencias del personal respecto a normatividad legal vigente.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 1,
                    impact: 4,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-4',
                    proc: 'DRC',
                    desc: 'No presentar informes a los órganos respectivos respecto al funcionamiento de Sagrilaft.',
                    cause: 'Incumplimiento al programa y cronograma establecido en la compañía para el año gravable.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-5',
                    proc: 'DRC',
                    desc: 'Incumplimiento en emisión de informes a UIAF y SuperSociedades.',
                    cause: 'Incumplimiento al programa y cronograma establecido por las entidades respectivas.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 2,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-6',
                    proc: 'DRC',
                    desc: 'Falta de documentación, soportes y aspectos relevantes en la Debida Diligencia.',
                    cause: 'Fallas en la documentación y trazabilidad al realizar la Debida Diligencia.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-7',
                    proc: 'DRC',
                    desc: 'Inexistencia de capacitaciones.',
                    cause: 'Falta de programas de capacitación a empleados o colaboradores.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 2,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-8',
                    proc: 'DRC',
                    desc: 'Falta de herramientas tecnológicas como parte de los recursos en el proceso.',
                    cause: 'Falta de presupuesto y actualización de nuevas herramientas tecnológicas.',
                    resp: 'DIRECCIÓN GESTIÓN DE RIESGO Y CUMPLIMIENTO',
                    prob: 1,
                    impact: 4,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-9',
                    proc: 'JUR',
                    desc: 'Incumplimiento en normatividad legal vigente de obligatorio cumplimiento.',
                    cause: 'Falta de conocimiento y competencias del personal.',
                    resp: 'DIRECCIÓN JURÍDICA',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-10',
                    proc: 'JUR',
                    desc: 'Inobservancia de libros, documentos y demás soportes legales de la compañía.',
                    cause: 'Falta de control a los libros exigibles y soportes que respaldan las operaciones.',
                    resp: 'DIRECCIÓN JURÍDICA',
                    prob: 2,
                    impact: 5,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-11',
                    proc: 'JUR',
                    desc: 'Contratos con cláusulas, errores u omisiones que representen desfavorabilidad para la compañía.',
                    cause: 'Falta de control y verificación en los documentos.',
                    resp: 'DIRECCIÓN JURÍDICA',
                    prob: 1,
                    impact: 4,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-12',
                    proc: 'JUR',
                    desc: 'Desconocimiento de procesos jurídicos.',
                    cause: 'Falta de investigación y circularización para obtener información de posibles procesos jurídicos.',
                    resp: 'DIRECCIÓN JURÍDICA',
                    prob: 2,
                    impact: 2,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-13',
                    proc: 'GH',
                    desc: 'Falta de correcta segregación de funciones.',
                    cause: 'No realizar un estudio minucioso de las actividades de cada colaborador.',
                    resp: 'DIRECCIÓN GESTIÓN HUMANA',
                    prob: 3,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-14',
                    proc: 'GH',
                    desc: 'Perfilamiento no idóneo para los diferentes cargos.',
                    cause: 'Falta de aplicación de pruebas técnicas y psicotécnicas para identificar fortalezas.',
                    resp: 'DIRECCIÓN GESTIÓN HUMANA',
                    prob: 4,
                    impact: 2,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-15',
                    proc: 'GH',
                    desc: 'Incumplimiento en pago de obligaciones laborales, aportes sociales y parafiscales.',
                    cause: 'Falta de recursos y cumplimiento de plazos establecidos.',
                    resp: 'DIRECCIÓN GESTIÓN HUMANA',
                    prob: 1,
                    impact: 5,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-16',
                    proc: 'GH',
                    desc: 'Conflicto de intereses.',
                    cause: 'Desconocimiento de código de ética, principios y valores corporativos.',
                    resp: 'DIRECCIÓN GESTIÓN HUMANA',
                    prob: 2,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-17',
                    proc: 'GH',
                    desc: 'Falta de programas de capacitación y entrenamiento (Backup).',
                    cause: 'Incumplimiento al programa y cronograma de capacitaciones y planes de entrenamiento.',
                    resp: 'DIRECCIÓN GESTIÓN HUMANA',
                    prob: 4,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-18',
                    proc: 'GH',
                    desc: 'Incumplimiento al Sistema de Gestión Seguridad y Salud en el Trabajo (SG SST).',
                    cause: 'Desconocimiento del funcionamiento del sistema y normatividad exigible.',
                    resp: 'DIRECCIÓN GESTIÓN HUMANA',
                    prob: 1,
                    impact: 5,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-19',
                    proc: 'DFC',
                    desc: 'Información financiera sin razonabilidad.',
                    cause: 'Fallas en el ingreso de información, soportes y software contable.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 2,
                    impact: 5,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-20',
                    proc: 'DFC',
                    desc: 'No aplicar las políticas contables correctas.',
                    cause: 'Falla en aplicación normativa NIIF (DUR 2420 de 2015) y regulación vigente.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-21',
                    proc: 'DFC',
                    desc: 'Atraso y falta de exactitud en registros de información contable, incluyendo estimaciones.',
                    cause: 'Falta de control en recepción, contabilización y revisión de registros.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 2,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-22',
                    proc: 'DFC',
                    desc: 'Inobservancia de documentos, soportes y archivo conforme la Ley 962 de 2005.',
                    cause: 'Falla en la metodología de almacenamiento y lineamientos para el archivo corporativo.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-23',
                    proc: 'DFC',
                    desc: 'No identificar y controlar la existencia de activos y/o bienes de la empresa.',
                    cause: 'No contar con la hoja de vida del activo.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-24',
                    proc: 'DFC',
                    desc: 'Mal funcionamiento, desactualización y falta de renovación de licencia de software contable.',
                    cause: 'Falta de programación y presupuesto para la renovación de licencias.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 1,
                    impact: 5,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-25',
                    proc: 'DFC',
                    desc: 'Incumplimiento en presentación y pago de obligaciones tributarias.',
                    cause: 'Falta de presupuesto y programación para el pago de obligaciones fiscales.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 5,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-26',
                    proc: 'DFC',
                    desc: 'Falta de planeación financiera.',
                    cause: 'Fallas en el presupuesto y estrategias financieras diseñadas para el año gravable.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 5,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-27',
                    proc: 'DFC',
                    desc: 'Destino o uso inadecuado de los recursos.',
                    cause: 'Incumplimiento de políticas en el proceso para el manejo financiero.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 1,
                    impact: 5,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-28',
                    proc: 'DFC',
                    desc: 'Manejo de efectivo.',
                    cause: 'Incumplimiento en políticas de tesorería.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 1,
                    impact: 4,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-29',
                    proc: 'DFC',
                    desc: 'Error en dispersión de pagos.',
                    cause: 'Falla en proceso de programación de pagos y los controles del mismo.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-30',
                    proc: 'DFC',
                    desc: 'Pagos sin los soportes correspondientes.',
                    cause: 'Incumplimiento en políticas de tesorería y requerimientos de proceso contable.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 2,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-31',
                    proc: 'DFC',
                    desc: 'Operaciones no autorizadas.',
                    cause: 'Incumplimiento en políticas de tesorería.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 5,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-32',
                    proc: 'DFC',
                    desc: 'Pagos extemporáneos.',
                    cause: 'Falta de programación de pagos y disponibilidad de recursos.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-33',
                    proc: 'DFC',
                    desc: 'Transacciones pendientes de legalizar.',
                    cause: 'Inadecuado seguimiento a anticipos y transacciones que requieren documentación.',
                    resp: 'DIRECCIÓN FINANCIERA Y CONTABLE',
                    prob: 3,
                    impact: 2,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-34',
                    proc: 'CRL',
                    desc: 'Portafolio reducido de clientes.',
                    cause: 'Incumplimiento de requisitos Sagrilaft y falta de estrategias comerciales.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 4,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-35',
                    proc: 'CRL',
                    desc: 'Riesgo de mercado (en cierres de negociaciones).',
                    cause: 'Variaciones y fluctuaciones de precios y tasas de mercado.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 5,
                    impact: 4,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-36',
                    proc: 'CRL',
                    desc: 'Restricción de coberturas financieras.',
                    cause: 'No mantener indicadores financieros favorables y reputación empresarial negativa.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 4,
                    impact: 4,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-37',
                    proc: 'CRL',
                    desc: 'Incumplimiento en fechas de entrega por razones logísticas y de transporte.',
                    cause: 'Falla en el proceso y coordinación de los diferentes terceros que intervienen.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 2,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-38',
                    proc: 'CRL',
                    desc: 'Inconsistencia en documentación exigible (factura comercial, lista de empaque, conocimiento de embarque, etc.).',
                    cause: 'Desconocimiento técnico en el proceso y falta de verificación documental.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 2,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-39',
                    proc: 'CRL',
                    desc: 'Falta de documentos o soportes de la cadena de suministro de material.',
                    cause: 'Falla en verificación documental de las compras del material.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 2,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-40',
                    proc: 'CRL',
                    desc: 'Material sin entrada y salida de almacén en sistema contable.',
                    cause: 'Incumplimiento de políticas contables y de control de inventarios.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-41',
                    proc: 'CRL',
                    desc: 'Programación de inventarios con periodos de baja frecuencia.',
                    cause: 'Incumplimiento al programa y cronograma establecido para el año gravable.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 3,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-42',
                    proc: 'CRL',
                    desc: 'Acceso de personal no autorizado al laboratorio.',
                    cause: 'Incumplimiento de políticas del proceso de laboratorio y seguridad.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-43',
                    proc: 'CRL',
                    desc: 'Equipos no revisados o en mal funcionamiento para el análisis del material.',
                    cause: 'Falta de programación de mantenimiento de equipos de laboratorio.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 2,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-44',
                    proc: 'CRL',
                    desc: 'Análisis inapropiado de material.',
                    cause: 'Desconocimiento técnico del proceso eficiente para este análisis.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 2,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-45',
                    proc: 'CRL',
                    desc: 'Vulnerabilidad en la seguridad del sitio donde funciona el laboratorio.',
                    cause: 'Incumplimiento de políticas de seguridad para custodiar el material.',
                    resp: 'DIRECCIÓN COMERCIAL',
                    prob: 3,
                    impact: 5,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-46',
                    proc: 'ASG',
                    desc: 'Riesgo en seguridad de la información.',
                    cause: 'Inexistencia de protocolos que eviten riesgos de ataques informáticos y errores humanos.',
                    resp: 'DIRECCIÓN TI',
                    prob: 3,
                    impact: 4,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-47',
                    proc: 'ASG',
                    desc: 'Copias de seguridad con periodos de baja frecuencia.',
                    cause: 'Falta de programación y automaticidad para las copias de la información.',
                    resp: 'DIRECCIÓN TI',
                    prob: 2,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-48',
                    proc: 'ASG',
                    desc: 'Ataque cibernético.',
                    cause: 'Falta de protocolos de seguridad.',
                    resp: 'DIRECCIÓN TI',
                    prob: 3,
                    impact: 5,
                    inherent: 'Extremo'
                },
                {
                    code: 'RSCI-49',
                    proc: 'ASG',
                    desc: 'Acceso de información a usuarios no autorizados.',
                    cause: 'Falla en delimitación o restricción de usuarios que acceden a la información.',
                    resp: 'DIRECCIÓN TI',
                    prob: 3,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-50',
                    proc: 'ASG',
                    desc: 'Licencias sin renovación.',
                    cause: 'Falta de programación y presupuesto de recursos para la renovación de licencias.',
                    resp: 'DIRECCIÓN TI',
                    prob: 1,
                    impact: 5,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-51',
                    proc: 'ASG',
                    desc: 'Activos de equipo de computación y comunicación sin mantenimientos preventivos y correctivos.',
                    cause: 'Falta de programación de mantenimiento a activos de equipo de computación.',
                    resp: 'DIRECCIÓN TI',
                    prob: 3,
                    impact: 2,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-52',
                    proc: 'ASG',
                    desc: 'Falta de aprobación de plan de sostenibilidad.',
                    cause: 'No contar con el debido presupuesto y objetivos para los programas de sostenibilidad.',
                    resp: 'DIRECCIÓN SOSTENIBILIDAD',
                    prob: 4,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-53',
                    proc: 'ASG',
                    desc: 'Inobservancia de políticas para los programas de sostenibilidad.',
                    cause: 'Al no tener planeación, se carece de políticas para la ejecución de programas.',
                    resp: 'DIRECCIÓN SOSTENIBILIDAD',
                    prob: 4,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-54',
                    proc: 'ASG',
                    desc: 'Adaptación de informes y reportes voluntarios (Circular Externa 100-000002 SuperSociedades, marzo 2025).',
                    cause: 'Desconocimiento del marco regulatorio frente a temas ASG (Ambiental, Social, Gobernanza).',
                    resp: 'DIRECCIÓN SOSTENIBILIDAD',
                    prob: 4,
                    impact: 2,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-55',
                    proc: 'DOLN',
                    desc: 'Falta de planeación y financiación para otras líneas de negocio.',
                    cause: 'No contar con el debido presupuesto y objetivos para otras líneas de negocio.',
                    resp: 'DIRECCIÓN OTRAS LÍNEAS DE NEGOCIO',
                    prob: 2,
                    impact: 3,
                    inherent: 'Alto'
                },
                {
                    code: 'RSCI-56',
                    proc: 'DOLN',
                    desc: 'Riesgo en envío de muestras a terceros del exterior.',
                    cause: 'Desconocimiento de proceso y regulación exigible para envío de muestras sin valor comercial.',
                    resp: 'DIRECCIÓN OTRAS LÍNEAS DE NEGOCIO',
                    prob: 1,
                    impact: 2,
                    inherent: 'Moderado'
                },
                {
                    code: 'RSCI-57',
                    proc: 'DOLN',
                    desc: 'Incumplimiento a asignaciones impartidas por Gerencia.',
                    cause: 'Asignar varias actividades de diferentes procesos que requieren tiempo y concentración.',
                    resp: 'DIRECCIÓN OTRAS LÍNEAS DE NEGOCIO',
                    prob: 1,
                    impact: 4,
                    inherent: 'Moderado'
                }
            ];

            const PROC_LABELS = {
                DRC: 'DRC.001 · Dirección de Riesgo y Cumplimiento',
                JUR: 'DJUR.002 · Dirección Jurídica',
                GH: 'GH.003 · Dirección Gestión Humana',
                DFC: 'DFC.004 · Dirección Financiero y Contable',
                CRL: 'CRL.005 · Dirección Comercial',
                ASG: 'ASG.006 · Dirección TI y Sostenibilidad',
                DOLN: 'DOLN.007 · Dirección Otras Líneas de Negocio'
            };

            function buildDesc(filter) {
                const container = document.getElementById('desc-container');
                const shown = filter === 'all' ? RISKS : RISKS.filter(r => r.proc === filter);
                if (filter === 'all') {
                    const procs = ['DRC', 'JUR', 'GH', 'DFC', 'CRL', 'ASG', 'DOLN'];
                    let html = '';
                    procs.forEach(p => {
                        const pRisks = shown.filter(r => r.proc === p);
                        if (pRisks.length === 0) return;
                        html += `<div class="process-header">${PROC_LABELS[p]}</div>`;
                        pRisks.forEach(r => {
                            const bc = r.inherent === 'Extremo' ? 'badge-extreme' : r.inherent === 'Alto' ? 'badge-high' : 'badge-moderate';
                            html += `<div class="desc-row"><div class="desc-code">${r.code} <span class="badge ${bc}">${r.inherent}</span></div><div class="desc-risk">${r.desc}</div><div class="desc-cause">→ ${r.cause}</div><div style="margin-top:5px;"><span class="desc-resp">${r.resp}</span></div></div>`;
                        });
                    });
                    container.innerHTML = html;
                } else {
                    let html = '';
                    shown.forEach(r => {
                        const bc = r.inherent === 'Extremo' ? 'badge-extreme' : r.inherent === 'Alto' ? 'badge-high' : 'badge-moderate';
                        html += `<div class="desc-row"><div class="desc-code">${r.code} <span class="badge ${bc}">${r.inherent}</span></div><div class="desc-risk">${r.desc}</div><div class="desc-cause">→ ${r.cause}</div><div style="margin-top:5px;"><span class="desc-resp">${r.resp}</span></div></div>`;
                    });
                    container.innerHTML = html || '<p style="color:var(--muted);font-size:12px;">Sin riesgos para este filtro.</p>';
                }
            }

            function filterDesc() {
                buildDesc(document.getElementById('descFilter').value);
            }

            function getZone(p, i) {
                const s = p * i;
                if (s >= 13) return 'extreme';
                if (s >= 6) return 'high';
                if (s >= 2) return 'moderate';
                return 'low';
            }

            function getZoneColor(z) {
                if (z === 'extreme') return '#C0392B';
                if (z === 'high') return '#E67E22';
                if (z === 'moderate') return '#F1C40F';
                return '#27AE60';
            }

            function buildThermal(filter) {
                const map = document.getElementById('thermal-map');
                const data = {};
                const shown = filter === 'all' ? RISKS : RISKS.filter(r => r.proc === filter);
                shown.forEach(r => {
                    const key = `${r.prob}_${r.impact}`;
                    if (!data[key]) data[key] = [];
                    data[key].push(r.code);
                });
                let html = '';
                for (let p = 5; p >= 1; p--) {
                    for (let i = 1; i <= 5; i++) {
                        const key = `${p}_${i}`;
                        const risks = data[key] || [];
                        const zone = getZone(p, i);
                        const col = getZoneColor(zone);
                        const txtCol = zone === 'moderate' ? '#333' : '#fff';
                        if (risks.length > 0) {
                            const labels = risks.map(c => `<div style="font-size:8px;font-weight:700;">${c.replace('RSCI-','R')}</div>`).join('');
                            html += `<div class="th-cell" style="background:${col};color:${txtCol};">${labels}</div>`;
                        } else {
                            html += `<div class="th-cell th-empty-cell" style="background:${col};"></div>`;
                        }
                    }
                }
                map.innerHTML = html;
            }

            function showThermal(proc, btn) {
                document.querySelectorAll('#thermal-tabs .thermal-tab').forEach(b => b.classList.remove('on'));
                btn.classList.add('on');
                buildThermal(proc);
            }

            window.onload = function() {
                buildDesc('all');
                buildThermal('all');
            };
        </script>
</x-app-layout>