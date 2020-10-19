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
        },
        primary: {
            main: '#7c69ef'
        },
        secondary: {
            main: '#d9e2ef'
        },
        success: {
            main: '#42ba96'
        },
        info: {
            main: '#467fd0'
        },
        warning: {
            main: '#ffc107'
        },
        error: {
            main: '#df4759'
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
        h1: {
            fontSize: '2.5rem',
            fontWeight: 500,
            lineHeight: 1.2,
            marginBottom: '0.5rem'
        },
        h2: {
            fontSize: '2rem',
            fontWeight: 500,
            lineHeight: 1.2,
            marginBottom: '0.5rem'
        },
        h3: {
            fontSize: '1.75rem',
            fontWeight: 500,
            lineHeight: 1.2,
            marginBottom: '0.5rem'
        },
        h4: {
            fontSize: '1.5rem',
            fontWeight: 500,
            lineHeight: 1.2,
            marginBottom: '0.5rem'
        },
        h5: {
            fontSize: '1.25rem',
            fontWeight: 500,
            lineHeight: 1.2,
            marginBottom: '0.5rem'
        },
        h6: {
            fontSize: '1rem',
            fontWeight: 500,
            lineHeight: 1.2,
            marginBottom: '0.5rem'
        }
    }
    /*overrides: {
        MuiCard: {
            root: {
                border: '1px solid rgba(0,40,100,0.12)',
                boxShadow: ''
            }
        }
    }*/
});

console.log(theme);

export default theme;
