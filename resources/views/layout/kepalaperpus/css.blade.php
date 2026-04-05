    <style>
        .img-square {
        width: 100px;
        height: 100px;
        object-fit: cover;
        }

        .profile-card {
        text-align: center;
        padding: 20px;
        }

        .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%; /* bikin bulat */
        object-fit: cover;
        margin-bottom: 10px;
        }

        .role {
        display: inline-block;
        background: #e7c87b;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 9px;
        margin-bottom: 7px;
        }

        .name {
        font-size: 15px;
        font-weight: 600;
        }


        /* switch container */
        .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
        }

        /* hide checkbox */
        .switch input {
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* slider */
        .slider {
        position: absolute;
        cursor: pointer;
        background-color: #ccc;
        transition: .4s;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 34px;
        }

        /* bulatannya */
        .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 3.5px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        }

        /* kalau ON */
        input:checked + .slider {
        background-color: #4CAF50;
        }

        /* geser ke kanan */
        input:checked + .slider:before {
        transform: translateX(24px);
        }
    </style>
