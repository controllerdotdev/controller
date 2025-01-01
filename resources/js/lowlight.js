import css from "highlight.js/lib/languages/css";
import js from "highlight.js/lib/languages/javascript";
import ts from "highlight.js/lib/languages/typescript";
import html from "highlight.js/lib/languages/xml";
import php from "highlight.js/lib/languages/php";
import bash from "highlight.js/lib/languages/bash";
import json from "highlight.js/lib/languages/json";
import ruby from "highlight.js/lib/languages/ruby";
import python from "highlight.js/lib/languages/python";

import { createLowlight } from "lowlight";
const lowlight = createLowlight();

lowlight.register({ css });
lowlight.register({ js });
lowlight.register({ ts });
lowlight.register({ html });
lowlight.register({ php });
lowlight.register({ bash });
lowlight.register({ json });
lowlight.register({ ruby });
lowlight.register({ python });

export default lowlight;
