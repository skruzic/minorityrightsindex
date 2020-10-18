import { createMuiTheme } from '@material-ui/core';

const theme = createMuiTheme({
    palette: {
        background: {
            default: '#f1f4f8'
        },
        grey: {
            100: '#f9f9fd',
            200: '#f1f4f8',
            300: '#d9e2ef',
            400: '#c6d3e6',
            500: '#abbcd5',
            600: '#869ab8',
            700: '#506690',
            800: '#384c74',
            900: '#1b2a4e'
        },
        common: {
            black: '#161c2d'
        }
    },
    typography: {
        fontFamily: [
            '-apple-system',
            'BlinkMacSystemFont',
            '"Segoe UI"',
            'Roboto',
            '"Helvetica Neue"',
            'Arial',
            '"Noto Sans"',
            'sans-serif',
            '"Apple Color Emoji"',
            '"Segoe UI Emoji"',
            '"Segoe UI Symbol"',
            '"Noto Color Emoji"'
        ].join(','),
        fontSize: 14,
        h2: {
            fontSize: '3.75rem',
            fontWeight: 500
        }
    }
});

console.log(theme);

export default theme;
