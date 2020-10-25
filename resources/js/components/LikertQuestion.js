import React from 'react';
import { withStyles } from '@material-ui/core';
import { Field } from 'redux-form';
import CardHeader from '@material-ui/core/CardHeader';
import CardContent from '@material-ui/core/CardContent';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import Box from '@material-ui/core/Box';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Typography from '@material-ui/core/Typography';
import TableContainer from '@material-ui/core/TableContainer';
import Table from '@material-ui/core/Table';
import TableHead from '@material-ui/core/TableHead';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import LikertQuestionRow from './LikertQuestionRow';

const LikertQuestion = ({
    classes,
    name,
    text,
    options,
    questions,
    input,
    invite,
    currentStep,
    ...rest
}) => {
    return (
        <>
            <CardHeader title={text} />
            <CardContent>
                <TableContainer>
                    <Table>
                        <TableHead>
                            <TableRow>
                                <TableCell />
                                {options.map((option, idx) => (
                                    <TableCell
                                        key={idx}
                                        className={classes.cell}
                                    >
                                        {option.text}
                                    </TableCell>
                                ))}
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {questions.map(q => (
                                <Field
                                    key={q.id}
                                    component={LikertQuestionRow}
                                    name={q.code}
                                    question={q}
                                    options={options}
                                    invite={invite}
                                    currentStep={currentStep}
                                />
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>
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
