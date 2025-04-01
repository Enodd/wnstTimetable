/* eslint-disable react/jsx-key */
import { useSidebarProvider } from '@/Hooks/useSidebarProvider';
import { GroupTree } from '@/Models/Group';
import { Accordion,
  AccordionDetails,
  AccordionSummary,
  CSSObject,
  Link,
  Stack,
  styled,
  Typography } from '@mui/material';
import React, { useState }  from 'react';
import { MdArrowDropDown, MdArrowDropUp } from 'react-icons/md';

const hoverBarAnimation = (color: string): CSSObject => {
  return {
    position: 'relative',
    '&:before': {
      content: '""',
      position: 'absolute',
      width: '100%',
      height: '2px',
      bottom: 0,
      left: 0,
      background: color,
      transform: 'scaleX(0)',
      willChange: 'transform',
      transition: '0.1s ease-in'
    },
    '&:hover:before': { transform: 'scaleX(1)' }
  };
};

const StyledLink = styled(Link)(function ({ theme }) {
  return ({
    background: '#c1c1c111',
    backdropFilter: 'blur(4px)',
    padding: theme.spacing(1.75),
    color: theme.palette.primary.light,
    boxShadow: '0px 2px 3px ' + theme.palette.primary.light,
    borderRadius: 4,
    ...hoverBarAnimation(theme.palette.primary.light)
  });
});

const GroupDisplay: React.FC<{ group: GroupTree }> = ({ group }) => {
  const [isExpanded, setIsExpanded] = useState<boolean>(false);
  if (group.subGroups.length === 0) {
    return <StyledLink href='x'>
      {group.name}
    </StyledLink>;
  }
  return <Accordion
    expanded={isExpanded}
    variant='elevation'
    onChange={() => setIsExpanded(prev => !prev)}>
    <AccordionSummary sx={theme => ({
      color: theme.palette.primary.dark, fontWeight: 'bold', '&.Mui-expanded': { margin: 0 }
    })}>
      <Stack
        alignItems={'center'}
        direction={'row'}
        justifyContent={'space-between'}
        width={'100%'}>
        <Typography
          component={'a'}
          href={'https://google.com'}
          sx={theme => ({ ...hoverBarAnimation(theme.palette.primary.contrastText) })}
          target='_blank'
          width='fit-content'
        >
          {group.name}
        </Typography>
        {isExpanded
          ? <MdArrowDropUp fontSize={'32px'} />
          : <MdArrowDropDown fontSize={'32px'} />}
      </Stack>
    </AccordionSummary>
    <AccordionDetails>
      <Stack gap={2}>
        {
          group.subGroups.map(el => <GroupDisplay group={el} /> )
        }
      </Stack>
    </AccordionDetails>
  </Accordion>;
};

export const GroupsTabView: React.FC = () => {
  const { groups } = useSidebarProvider();
  return <>
    {groups?.length > 0 ? groups?.map(group => <GroupDisplay group={group} />) : <></>}
  </>;
};