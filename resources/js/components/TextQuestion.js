import React from 'react';
import TextField from '@material-ui/core/TextField';
import Typography from '@material-ui/core/Typography';

const TextQuestion = ({ name, text, questionType, input, ...custom }) => (
    <div>
        <Typography>{text}</Typography>
        <TextField
            name={name}
            variant="outlined"
            id={name}
            multiline={questionType === 1}
            rowsMax={4}
            {...input}
            {...custom}
        />
    </div>
);

export default TextQuestion;
