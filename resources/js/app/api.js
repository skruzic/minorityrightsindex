import axios from 'axios';

// Prefer MIX_APP_URL when set at build time; fall back to same-origin /api
// so preview and survey still work if the Mix env var was omitted.
export default axios.create({
    baseURL: `${process.env.MIX_APP_URL || ''}/api`
});
