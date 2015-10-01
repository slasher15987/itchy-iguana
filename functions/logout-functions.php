<?php

function loggedOut() {
session_start();
session_regenerate_id();
session_destroy();
}