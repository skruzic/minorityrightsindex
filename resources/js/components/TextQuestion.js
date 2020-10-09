import React from 'react';
import TextField from '@material-ui/core/TextField';
import Typography from '@material-ui/core/Typography';

const TextQuestion = ({ question }) => (
    <>
        <Typography>{question.text}</Typography>
        <TextField
            variant="outlined"
            id="standard-required"
            multiline={question.type === 1}
            rowsMax={4}
        />
    </>
);

export default TextQuestion;
