import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link, usePage } from '@inertiajs/react';
import { PropsWithChildren, ReactNode, useState } from 'react';

export default function Authenticated({
  header,
  children,
}: PropsWithChildren<{ header?: ReactNode }>) {
  const user = usePage().props.auth.user;

  const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

  return (
    <div className='min-h-screen bg-gray-100'>
      <nav className='border-b border-gray-100 bg-white'>
        <div className='mx-auto max-w-7xl px-4 sm:px-6 lg:px-8'>
          <div className='flex h-16 justify-between'>
            <div className='flex'>
              <div className='flex shrink-0 items-center'>
                <Link href='/'>
                  <ApplicationLogo className='block h-9 w-auto fill-current text-gray-800' />
                </Link>
              </div>
              <div className='hidden space-x-8 sm:-my-px sm:ms-10 sm:flex'>
                <NavLink
                  active={route().current('dashboard')}
                  href={route('dashboard')}
                >
                  Dashboard
                </NavLink>
              </div>
            </div>
            <div className='hidden sm:ms-6 sm:flex sm:items-center'>
              <div className='relative ms-3'>
                <Dropdown>
                  <Dropdown.Trigger>
                    <span className='inline-flex rounded-md'>
                      <button
                        className='inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none'
                        type='button'
                      >
                        {user.name}
                        <svg
                          className='-me-0.5 ms-2 h-4 w-4'
                          fill='currentColor'
                          viewBox='0 0 20 20'
                          xmlns='http://www.w3.org/2000/svg'
                        >
                          <path
                            clipRule='evenodd'
                            d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z'
                            fillRule='evenodd'
                          />
                        </svg>
                      </button>
                    </span>
                  </Dropdown.Trigger>
                  <Dropdown.Content>
                    <Dropdown.Link
                      href={route('profile.edit')}
                    >
                      Profile
                    </Dropdown.Link>
                    <Dropdown.Link
                      as='button'
                      href={route('logout')}
                      method='post'
                    >
                      Log Out
                    </Dropdown.Link>
                  </Dropdown.Content>
                </Dropdown>
              </div>
            </div>
            <div className='-me-2 flex items-center sm:hidden'>
              <button
                className='inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none'
                onClick={() =>
                  setShowingNavigationDropdown(
                    (previousState) => !previousState
                  )
                }
              >
                <svg
                  className='h-6 w-6'
                  fill='none'
                  stroke='currentColor'
                  viewBox='0 0 24 24'
                >
                  <path
                    d='M4 6h16M4 12h16M4 18h16'
                    strokeLinecap='round'
                    strokeLinejoin='round'
                    strokeWidth='2'
                    className={
                      !showingNavigationDropdown
                        ? 'inline-flex'
                        : 'hidden'
                    }
                  />
                  <path
                    d='M6 18L18 6M6 6l12 12'
                    strokeLinecap='round'
                    strokeLinejoin='round'
                    strokeWidth='2'
                    className={
                      showingNavigationDropdown
                        ? 'inline-flex'
                        : 'hidden'
                    }
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div
          className={
            (showingNavigationDropdown ? 'block' : 'hidden') +
                        ' sm:hidden'
          }
        >
          <div className='space-y-1 pb-3 pt-2'>
            <ResponsiveNavLink
              active={route().current('dashboard')}
              href={route('dashboard')}
            >
              Dashboard
            </ResponsiveNavLink>
          </div>
          <div className='border-t border-gray-200 pb-1 pt-4'>
            <div className='px-4'>
              <div className='text-base font-medium text-gray-800'>
                {user.name}
              </div>
              <div className='text-sm font-medium text-gray-500'>
                {user.email}
              </div>
            </div>
            <div className='mt-3 space-y-1'>
              <ResponsiveNavLink href={route('profile.edit')}>
                Profile
              </ResponsiveNavLink>
              <ResponsiveNavLink
                as='button'
                href={route('logout')}
                method='post'
              >
                Log Out
              </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>
      {header && (
        <header className='bg-white shadow'>
          <div className='mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8'>
            {header}
          </div>
        </header>
      )}
      <main>{children}</main>
    </div>
  );
}
