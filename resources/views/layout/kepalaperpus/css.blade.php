    <style>
        .profile-card {
            text-align: center;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            display: block;
        }

        .role {
            display: inline-block;
            background: #AAF8AA;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 9px;
            margin-bottom: 7px;
        }

        .name {
            font-size: 15px;
            font-weight: 600;
            margin-top: 0;
        }

        /*bg sidebar*/
        .sidebar {
            background-image: url('{{ asset("assets/images/dg-perpus-sidebar.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .sidebar {
            background: #dae7ff;
        }

        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease-out;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        /* Animasi masuk */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Ikon pakai pseudo-element (opsional) */
        .alert-danger::before {
            content: "⚠️";
            font-size: 1.25rem;
        }

        .alert-success::before {
            content: "✅";
            font-size: 1.25rem;
        }
    </style>
