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

/* hide checkbox but still clickable */
.switch input {
    opacity: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    cursor: pointer;
    margin: 0;
    z-index: 2;
}

/* slider background */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 34px;
    z-index: 1;
}

/* the circle */
.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 3.5px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

/* checked state background */
.switch input:checked + .slider {
    background-color: #4CAF50;
}

/* move the circle when checked */
.switch input:checked + .slider:before {
    transform: translateX(24px);
}

/* optional: add hover effect */
.switch:hover .slider {
    background-color: #b5b5b5;
}
    </style>
