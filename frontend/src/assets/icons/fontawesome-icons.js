import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import {faEdit, faPhone, faPlus} from "@fortawesome/free-solid-svg-icons";
import { faUser } from "@fortawesome/free-solid-svg-icons";
import { faFlag } from "@fortawesome/free-solid-svg-icons";
import { faEye } from "@fortawesome/free-solid-svg-icons";
import { faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";

library.add(faPhone);
library.add(faUser);
library.add(faFlag);
library.add(faEyeSlash);
library.add(faEye);
library.add(faEdit);
library.add(faTrash);
library.add(faPlus);

export default FontAwesomeIcon;