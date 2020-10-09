import React, { useState } from 'react';
import PropTypes from 'prop-types';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import FormGroup from '@material-ui/core/FormGroup';
import FormHelperText from '@material-ui/core/FormHelperText';
import Typography from '@material-ui/core/Typography';

const CheckboxQuestion = () => {
    const [value, setValue] = useState({});

    const handleChange = event => {
        setValue({ ...value, [event.target.value]: event.target.checked });
    };

    return (
        <>
            <Typography>Ovdje dolazi pitanje</Typography>
            <FormControl component="fieldset">
                <FormGroup name="ime" value={value}>
                    <FormControlLabel
                        control={<Checkbox onChange={handleChange} />}
                        label="Label1"
                        value="label1"
                    />
                    <FormControlLabel
                        control={<Checkbox onChange={handleChange} />}
                        label="Label2"
                        value="label2"
                    />
                    <FormControlLabel
                        control={<Checkbox onChange={handleChange} />}
                        label="Label3"
                        value="label3"
                    />
                </FormGroup>
            </FormControl>
        </>
    );
};

export default CheckboxQuestion;
