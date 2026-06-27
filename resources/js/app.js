
// app.js
//
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import './globals/theme.js'; /* By Sheaf.dev */ 
import './globals/modals.js';
import './components/calendar/index.js';
import './components/date-picker/index.js';
import './components/time-picker/index.js';
import rover from "@sheaf/rover"
import './components/select.js';

// now you can register
// components using Alpine.data(...) and
// plugins using Alpine.plugin(...) 

Alpine.plugin(rover)
Livewire.start()