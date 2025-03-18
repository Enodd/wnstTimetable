import React, { createContext, PropsWithChildren } from 'react';

interface GameProps {}

export const GameContext = createContext<GameProps>({});

export const GameProvider: React.FC<PropsWithChildren> = ({ children }) => {
  return <GameContext.Provider value={}>
    {children}
  </GameContext.Provider>;
};