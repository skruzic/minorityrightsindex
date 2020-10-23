import React from 'react';
import { withStyles } from '@material-ui/core';
import { Field } from 'redux-form';
import CardHeader from '@material-ui/core/CardHeader';
import CardContent from '@material-ui/core/CardContent';
import TableContainer from '@material-ui/core/TableContainer';
import Table from '@material-ui/core/Table';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import TableCell from '@material-ui/core/TableCell';
import TableBody from '@material-ui/core/TableBody';
import LikertQuestionRow from './LikertQuestionRow';
import RadioQuestion from './RadioQuestion';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import Box from '@material-ui/core/Box';
import FormControl from '@material-ui/core/FormControl';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Typography from '@material-ui/core/Typography';

const LikertQuestion = ({
    classes,
    name,
    text,
    options,
    questions,
    input,
    ...rest
}) => {
    console.log(rest);
    return (
        <>
            <CardHeader title={text} />
            <CardContent>
                <Box className={classes.table}>
                    <div className={classes.row}>
                        <Typography className={classes.cell} />
                        {options.map((option, idx) => (
                            <Typography key={idx} className={classes.cell}>
                                {option.text}
                            </Typography>
                        ))}
                    </div>
                    {questions.map(q => (
                        <RadioGroup key={q.id} className={classes.row}>
                            <Typography className={classes.cell}>
                                {q.text}
                            </Typography>
                            {options.map((option, idx) => (
                                <FormControlLabel
                                    key={idx}
                                    control={<Radio />}
                                    label={null}
                                    name={q.code}
                                    value={option.value.toString()}
                                    className={classes.cell}
                                />
                            ))}
                        </RadioGroup>
                    ))}
                </Box>
            </CardContent>
        </>
    );
};

const styles = {
    table: {
        display: 'flex',
        flexDirection: 'column'
    },
    row: {
        display: 'flex',
        flexDirection: 'row',
        alignItems: 'center'
    },
    cell: {
        flex: '1 1 0',
        margin: '0 auto'
    }
};

export default withStyles(styles)(LikertQuestion);
