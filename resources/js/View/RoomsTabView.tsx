import { SidebarLink } from '@/Components/SidebarLink';
import { useSidebarProvider } from '@/Hooks/useSidebarProvider';
import { hoverBarAnimation } from '@/Theme/hoverBarAnimation';
import { Accordion,
  AccordionDetails,
  AccordionSummary,
  Stack,
  Typography,
  useTheme } from '@mui/material';
import React, { useState } from 'react';
import { MdArrowDropDown, MdArrowDropUp } from 'react-icons/md';
import { Room, Rooms } from '@/Models/Room.ts';

const RoomDisplay: React.FC<{ room: Room }> = ({ room }) => {
  return (
    <SidebarLink href='x'>
      {room.room_nr}
    </SidebarLink>
  );
};

const RoomsDisplay: React.FC<{ rooms: Rooms }> = ({ rooms }) => {
  const theme = useTheme();
  const [isExpanded, setIsExpanded] = useState<boolean>(false);

  const handleTabExpand = (e: React.SyntheticEvent) => {
    e.currentTarget.parentElement?.scrollIntoView({
      behavior: 'smooth',
      block: 'start',
    });
    setIsExpanded((prev) => !prev);
  };

  return (
    <Accordion
      expanded={isExpanded}
      variant='outlined'
      onChange={handleTabExpand}
    >
      <AccordionSummary
        sx={{
          color: theme.palette.primary.dark,
          fontWeight: 'bold',
          '&.Mui-expanded': { margin: 0 },
        }}
      >
        <Stack
          alignItems={'center'}
          direction={'row'}
          justifyContent={'space-between'}
          width={'100%'}
        >
          <Typography
            component={'a'}
            href={'https://google.com'}
            sx={{ ...hoverBarAnimation(theme.palette.primary.contrastText) }}
            target='_blank'
            width='fit-content'
          >
            {rooms.name}
          </Typography>
          {isExpanded ? (
            <MdArrowDropUp fontSize={'32px'} />
          ) : (
            <MdArrowDropDown fontSize={'32px'} />
          )}
        </Stack>
      </AccordionSummary>
      <AccordionDetails>
        <Stack gap={1}>
          {rooms.children.length > 0 ? (
            rooms.children.map((el) => (
              <RoomsDisplay
                key={rooms.name}
                rooms={el} />
            ))
          ) : rooms.rooms.length > 0 ? (
            rooms.rooms.map((room) => (
              <RoomDisplay
                key={room.room_nr}
                room={room}
              />
            ))
          ) : undefined}
        </Stack>
      </AccordionDetails>
    </Accordion>
  );
};

export const RoomsTabView: React.FC = () => {
  const { rooms } = useSidebarProvider();
  return (
    <>
      {rooms.length > 0 ? (
        rooms.map((room) => (
          <RoomsDisplay
            key={`top-${room.name}`}
            rooms={room}
          />
        ))
      ) : undefined}
    </>
  );
};
